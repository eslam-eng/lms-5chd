<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CourseInstallmentPlan;
use App\Models\Installment;
use App\Models\InstallmentDetail;
use App\Models\Webinar;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InstallmentController extends Controller
{
    public function index()
    {
        $this->authorize('admin_categories_list');

        $query = Installment::query();

        if (request()->get('course'))
        {
            $coursesId = Webinar::where('title','like', '%' . request()->get('course') . '%')->pluck('id');
            $planIds = CourseInstallmentPlan::whereIn('id',$coursesId)->pluck('id');
            $query->whereIn('installment_plan_id',$planIds);
        }

        if (request()->get('student'))
        {
            $studentIds = User::where('full_name','like', '%' . request()->get('student') . '%')->pluck('id');
            $query->whereIn('student_id',$studentIds);
        }
        $installments = $query->with(['installmentInfo','studentInfo'])->withCount([
            'installmentDetails',
            'installmentDetails as notPaid' => function ($query) {
                $query->where('status', 0);
            },
            'installmentDetails as paid' => function ($query) {
                $query->where('status', 1);
            }

        ])
            ->orderBy('id', 'desc')
            ->paginate(10);
        $data = [
            'pageTitle' => trans('admin/main.installment_new_list_title'),
            'installments' => $installments
        ];

        return view('admin.installments.list', $data);
    }

    public function create()
    {
        $this->authorize('admin_categories_create');
        $cources = Webinar::where('type',Webinar::$course)->where('status',Webinar::$active)->get(['id','title','slug','price']);
        $students = User::where('role_id',1)->get(['id','full_name','mobile']);
        $data = [
            'pageTitle' => trans('admin/main.installment_new_page_title'),
            'students' => $students,
            'courses' => $cources,
        ];

        return view('admin.installments.create', $data);
    }

    public function store(Request $request)
    {

        $data =  $this->validate($request, [
            'installment_plan_id' => 'required|exists:course_installment_plans,id',
            'student_id' => 'required|exists:users,id',
            'webinar_id' => 'required',
            'payment_value' => 'required|integer',
            'discount_value' => 'nullable|integer',
            'payment_type' => 'required',
            'note' => 'nullable|string',
        ]);
        $this->authorize('admin_categories_create');
        $installment = CourseInstallmentPlan::find($request->input('installment_plan_id'));
        $installment_interval_type = $installment->installment_type;
        $installment_interval_num = $installment->installment_interval_number;
        $installment_num = $installment->installment_num;

        $discount = $request->input('payment_value')??0;
        $courseprice = $installment->price;
        $installment_remain = $courseprice-($request->input('payment_value')+$discount);
        $data['remain']=$installment_remain;
        $installment = Installment::create($data);
        if ($installment&&$installment_remain>0)
        {
            $interval_time = $installment_interval_num/$installment_num;
            for($start=0;$start<$installment_num;$start++)
            {
                $installment_date = Carbon::now()->addUnit($installment_interval_type,$interval_time*$start+1)->startOfDay()->toDateString();
                $data = [
                    'date_collection'=>strtotime($installment_date),
                    'collection_value'=>$installment_remain/$installment_num,
                    'parent_installment_id'=>$installment->id,
                ];
                InstallmentDetail::create($data);
            }
        }

        return redirect('/admin/installment/'.$installment->id."/details");
    }

    public function show($id)
    {
        $installments = Installment::with(['installmentInfo','installmentDetails'])
            ->find($id);

        $data = [
            'pageTitle' => trans('admin/main.installment_detail'),
            'installments' => $installments
        ];
        return view('admin.installments.show', $data);
    }

    public function edit($id)
    {
        $this->authorize('admin_categories_edit');

        $category = Category::findOrFail($id);
        $subCategories = Category::where('parent_id', $category->id)
            ->orderBy('order', 'asc')
            ->get();

        $data = [
            'pageTitle' => trans('admin/pages/categories.edit_page_title'),
            'category' => $category,
            'subCategories' => $subCategories
        ];

        return view('admin.categories.create', $data);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy(Request $request, $id)
    {
        $this->authorize('admin_categories_delete');

        $installment = Installment::where('id', $id)->first();

        if (!empty($installment)) {
            $installment->delete();
            $toastData = [
                'title' => trans('public.request_success'),
                'msg' => 'deleted successfully',
                'status' => 'success'
            ];
        }else
            $toastData = [
                'title' => trans('public.request_failed'),
                'msg' => 'there is an error',
                'status' => 'error'
            ];

        return back()->with('toast',$toastData);
    }


    public function getCourseInstallmentPlans(Request $request)
    {
        $installmentPlans = CourseInstallmentPlan::where('webinar_id',$request->course_id)->get();
        if (count($installmentPlans))
            return response()->json(['status' => true, 'courses' => $installmentPlans]);
        return response()->json(['status' => false, 'message' =>'No Installment Plan']);

    }

    public function installmentPaid($id)
    {
        $installmentDetailsUpdated = InstallmentDetail::where('id',$id)->update(['status'=>1]);
        if ($installmentDetailsUpdated)
             $toastData = [
            'title' => trans('public.request_success'),
            'msg' => 'status Changed Successfully',
            'status' => 'success'
        ];
        else
            $toastData = [
                'title' => trans('public.request_failed'),
                'msg' => 'there is an error',
                'status' => 'error'
            ];
        return back()->with('toast',$toastData);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CertificatesExport;
use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Role;
use App\Models\StudentCertificate;
use App\Models\Webinar;
use App\User;
use App\Models\Quiz;
use App\Models\CertificateTemplate;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentCertificateController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('admin_certificate_list');

        $query = StudentCertificate::query();

        if (request()->get('certificate_id'))
            $query->where('certificate_id',request()->get('certificate_id'));

        if (request()->get('status'))
            $query->where('status',request()->get('status'));

        if (request()->get('course'))
        {
            $coursesId = Webinar::where('title','like', '%' . request()->get('course') . '%')->pluck('id');
            $query->whereIn('course_id',$coursesId);
        }

        if (request()->get('student'))
        {
            $studentIds = User::where('full_name','like', '%' . request()->get('student') . '%')->pluck('id');
            $query->whereIn('student_id',$studentIds);
        }

        $studentCertificates = $query->with(['student', 'course',])
            ->paginate(10)->groupBy('student_id');

        $data = [
            'pageTitle' => trans('admin/main.certificate_list_page_title'),
            'studentCertificates'=>$studentCertificates

        ];

        return view('admin.student-certificate.list', $data);
    }

    public function create()
    {
        $this->authorize('admin_certificate_template_create');
        $courses = Webinar::where('status',Webinar::$active)->get(['id','title','slug']);
        $students = User::where('role_name',Role::$user)->get(['id','full_name']);

        $data = [
            'pageTitle' => trans('admin/main.certificate_new_template_page_title'),
            'courses' => $courses,
            'students' => $students,
        ];

        return view('admin.student-certificate.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('admin_certificate_template_create');

        $rules = [
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:webinars,id',
            'status' => 'required',
            'degree' => 'required',
            'notes' => 'string|nullable',
            'attachment' => 'nullable',

        ];
        $this->validate($request, $rules);

        $data = [
            'student_id' => $request->get('student_id'),
            'course_id' => $request->get('course_id'),
            'status' => $request->get('status'),
            'degree' => $request->get('degree'),
            'notes' => $request->get('notes'),
            'attachment' => $request->get('attachment'),
            'certificate_id' => time(),
        ];
        if (StudentCertificate::create($data))
            $toastData = [
                'title' => trans('public.request_success'),
                'msg' => trans('admin/main.certificates_added'),
                'status' => 'success'
            ];

        return redirect('/admin/certificates')->with('toast',$toastData);
    }


    public function delete($id)
    {
        $this->authorize('admin_certificate_template_delete');

        $template = StudentCertificate::findOrFail($id);

        $template->delete();
        $toastData = [
            'title' => trans('public.request_success'),
            'msg' => trans('admin/main.deleted_success'),
            'status' => 'success'
        ];

        return redirect('/admin/certificates')->with('toast',$toastData);
    }

    public function CertificatesDownload($id)
    {
        $certificate = Certificate::findOrFail($id);

        if (!empty($certificate->file)) {
            if (file_exists(public_path($certificate->file))) {
                return response()->download(public_path($certificate->file));
            }
        }

        abort(404);
    }

    public function exportExcel(Request $request)
    {
        $this->authorize('admin_certificate_export_excel');

        $query = Certificate::query();

        $query = $this->filters($query, $request);

        $certificates = $query->with(
            [
                'quiz' => function ($query) {
                    $query->with('webinar');
                },
                'student',
                'quizzesResult'
            ]
        )->orderBy('created_at', 'desc')
            ->get();

        $export = new CertificatesExport($certificates);

        return Excel::download($export, 'certificates.xlsx');
    }
}

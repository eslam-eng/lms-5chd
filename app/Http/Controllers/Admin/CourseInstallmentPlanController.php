<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseInstallmentPlan;
use App\Models\Ticket;
use App\Models\Webinar;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Validator;

class CourseInstallmentPlanController extends Controller
{
    public function store(Request $request)
    {
        $this->authorize('admin_webinars_edit');

        $this->validate($request, [
            'title' => 'required|max:64',
            'price' => 'required',
            'installment_type' => 'required',
            'installment_interval_number' => 'required',
            'instalment_num' => 'required',
            'default_payment' => 'required',
        ]);


        $data = $request->all();


        if (!empty($data['webinar_id'])) {
            $webinar = Webinar::findOrFail($data['webinar_id']);
            CourseInstallmentPlan::create([
                'creator_id' => $webinar->creator_id,
                'webinar_id' => $webinar->id,
                'title' => $data['title'],
                'price' => $data['price'],
                'installment_type' => $data['installment_type'],
                'installment_interval_number' => $data['installment_interval_number'],
                'instalment_num' => $data['instalment_num'],
                'default_payment' => $data['default_payment'],
            ]);

        }

        return response()->json([
            'code' => 200,
        ], 200);
    }

    public function edit(Request $request, $id)
    {
        $this->authorize('admin_webinars_edit');


        $installment = CourseInstallmentPlan::select('title', 'price', 'installment_type', 'installment_interval_number', 'instalment_num','default_payment')
            ->where('id', $id)
            ->first();

        if (!empty($installment)) {
            return response()->json([
                'installment' => $installment
            ], 200);
        }


        return response()->json([], 422);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin_webinars_edit');

        $this->validate($request, [
            'title' => 'required|max:64',
            'price' => 'required',
            'webinar_id	' => 'required',
            'creator_id' => 'required',
            'installment_type' => 'required',
            'installment_interval_number' => 'required',
            'instalment_num' => 'required',
            'default_payment' => 'required',
        ]);
        $data = $request->all();

        $installmentPlan = CourseInstallmentPlan::find($id);

        $date = $data['date'];
        $date = explode(' - ', $date);

        $installmentPlan->update([
            'title' => $data['title'],
            'installment_type' => $data['installment_type'],
            'installment_interval_number' => $data['installment_interval_number'],
            'instalment_num' => $data['instalment_num'],
            'default_payment' => $data['default_payment'],
        ]);

        return response()->json([
            'code' => 200,
        ], 200);
    }

    public function destroy(Request $request, $id)
    {
        $this->authorize('admin_webinars_edit');

        CourseInstallmentPlan::find($id)->delete();

        return back();
    }
}

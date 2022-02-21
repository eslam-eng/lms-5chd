<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\InterviewAnswer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class InterviewAnswerController extends Controller
{
    //        todo add permission here
    public function interviewQuestions($id)
    {

        $this->authorize('admin_filters_list');
        $id = Crypt::decrypt($id);
        $student = User::findOrFail($id);
        if ($student)
        {
            $school_level = $student->school_level??1;
            $cultureQuestions = Interview::firstWhere(['school_level'=>$school_level,'title'=>'cultural questions']);
            $technicalQuestions = Interview::firstWhere(['school_level'=>$school_level,'title'=>'technical questions']);

            if ($cultureQuestions){
                $cultureQuestions->load(['questions'=>function($query){
                    $query->inRandomOrder()->take(5);
                }])->get();
            }

            if ($technicalQuestions)
            {
                $technicalQuestions->load(['questions'=>function($query){
                    $query->inRandomOrder()->take(5);
                }])->get();
            }

              $data = [
                  "student_id"=>Crypt::encrypt($id),
                  'pageTitle' => trans('admin/main.interview_list_page_title'),
                  'cultureQuestions' => $cultureQuestions->questions??null,
                  'technicalQuestions' => $technicalQuestions->questions??null
              ];
              return view('web.default.interview.interview', $data);
        }

    }

    public function interviewInswers(Request $request)
    {
       $student_id = Crypt::decrypt($request->student_id);
        foreach ($request->questions as $key=>$question)
        {
            $data = [
              "student_id"=>$student_id,
              "question_id"=>$question,
              "answer"=>$request->answers[$key],
            ];
            InterviewAnswer::create($data);
        }
        return response()->json(['status'=>true,'message'=>trans('public.question_hint_success')]);

    }

}

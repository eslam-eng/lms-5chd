<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\InterviewQuestion;
use Illuminate\Http\Request;

class InterviewQuestionController extends Controller
{
    public function index()
    {
        $this->authorize('admin_filters_list');

        $interviewQuestions = Interview::with('questions')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $data = [
            'pageTitle' => trans('admin/main.interview_list_page_title'),
            'interviewQuestions' => $interviewQuestions
        ];

        return view('admin.interview-questions.lists', $data);
    }

    public function create()
    {
        $this->authorize('admin_filters_create');
        $data = [
            'pageTitle' => trans('admin/main.interview_new_page_title'),
        ];

        return view('admin.interview-questions.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('admin_filters_create');

        $data = $this->validate($request, [
            'school_level' => 'required',
            'title' => 'required|min:3|max:128',
            'questions'   => 'required|array|min:1',
            'questions.*' => 'required|string',
        ]);
       $data['questions']= array_filter($request->questions, function($v) { return !is_null($v); });
        $interview = Interview::create([
            'title' => $request->input('title'),
            'school_level' => $request->input('school_level'),
        ]);

        if ($interview){
            if (!empty($data['questions'])) {
                foreach ($data['questions']as $question)
                {
                    $interview->questions()->create([
                        'question'=>$question
                    ]);
                }
            }
            $toastData = [
                'title' => trans('public.request_success'),
                'msg' => 'question added Successfully',
                'status' => 'success'
            ];
            return redirect('/admin/interview-questions')->with('toast',$toastData);
        }



    }

    public function show($id)
    {
        $this->authorize('admin_filters_edit');

        $interview = Interview::findOrFail($id);
        $interviewQuestions = InterviewQuestion::where('interview_id', $interview->id)
            ->get();

        $data = [
            'pageTitle' => trans('admin/main.interview_question_show'),
            'interview' => $interview,
            'interviewQuestions' => $interviewQuestions,
        ];

        return view('admin.interview-questions.show', $data);
    }

    public function edit($id)
    {
        $this->authorize('admin_filters_edit');

        $interview = Interview::findOrFail($id);
        $interviewQuestions = InterviewQuestion::where('interview_id', $interview->id)
            ->get();

        $data = [
            'pageTitle' => trans('admin/main.interview_question_edit'),
            'interview' => $interview,
            'interviewQuestions' => $interviewQuestions,
        ];

        return view('admin.interview-questions.create', $data);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin_filters_edit');

        $data = $this->validate($request, [
            'school_level' => 'required',
            'title' => 'required|min:3|max:128',
            'questions' => 'required|array|min:3',
        ]);

        $data['questions']= array_filter($request->questions, function($v) { return !is_null($v); });

        $interview = Interview::findOrFail($id);
        $interview->update([
            'title' => $request->input('title'),
            'school_level' => $request->input('school_level'),
        ]);
        if (!empty($data['questions']))
        {
            $interview->questions()->delete();
            foreach ($data['questions']as $question)
            {
                $interview->questions()->create([
                    'question'=>$question
                ]);
            }
            $toastData = [
                'title' => trans('public.request_success'),
                'msg' => 'question updated Successfully',
                'status' => 'success'
            ];
            return redirect('/admin/interview-questions')->with('toast',$toastData);
        }
        $toastData = [
            'title' => trans('public.request_failed'),
            'msg' => 'there is an error',
            'status' => 'error'
        ];
        return back()->with('toast',$toastData);
    }

    public function destroy($id)
    {
        $this->authorize('admin_filters_delete');

        $interview = Interview::findOrFail($id);
        if ($interview)
        {
            $interview->delete();
            $toastData = [
                'title' => trans('public.request_success'),
                'msg' => 'deleted successfully',
                'status' => 'success'
            ];
            return redirect('/admin/interview-questions')->with('toast',$toastData);
        }

    }

}

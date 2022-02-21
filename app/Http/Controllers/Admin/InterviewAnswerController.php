<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\InterviewAnswer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class InterviewAnswerController extends Controller
{
    public function studentAnswer($id)
    {
        $student = User::with('interViewAnswer')->find($id);
        if ($student)
            return view('admin.interview-answer.interview_answer',['student'=>$student]);

    }
}

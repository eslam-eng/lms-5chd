<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewAnswer extends Model
{
    protected $fillable =['student_id','question_id', 'answer'];
    public $timestamps = true;

    public function student()
    {
        return $this->belongsTo('App\User','student_id');
    }

    public function question()
    {
        return $this->belongsTo('App\Models\InterviewQuestion','question_id');
    }
}

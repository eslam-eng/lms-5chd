<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCertificate extends Model
{
    protected $fillable = ['student_id','course_id','degree','status','notes','certificate_id','attachment'];

    public function student()
    {
        return $this->belongsTo('App\User','student_id');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Webinar','course_id');
    }
}

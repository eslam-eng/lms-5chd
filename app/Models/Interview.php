<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $guarded = ['id'];

    static $cacheKey = 'interview';

    public function questions()
    {
        return $this->hasMany('App\Models\InterviewQuestion', 'interview_id', 'id');
    }
}

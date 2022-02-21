<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewQuestion extends Model
{
    protected $fillable = ['question','interview_id'];
    protected $guarded = ['id'];

    static $cacheKey = 'interview';

    public function interview()
    {
        $this->belongsTo('App\Models\Interview','interview_id');
    }
}

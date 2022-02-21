<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseInstallmentPlan extends Model
{
    protected $guarded = ['id'];

    public function webinarDetail()
    {
        return $this->belongsTo('App\Models\Webinar','webinar_id');
    }


}

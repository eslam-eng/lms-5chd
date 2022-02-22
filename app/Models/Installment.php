<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $table = 'installments';

    protected $guarded = ['id'];

    static $cacheKey = 'installment';

    public function installmentDetails()
    {
        return $this->hasMany('App\Models\InstallmentDetail', 'parent_installment_id', 'id');
    }
    public function installmentInfo()
    {
        return $this->belongsTo('App\Models\CourseInstallmentPlan','installment_plan_id')->with('webinarDetail');
    }

    public function studentInfo()
    {
        return $this->belongsTo('App\User','student_id');
    }

    public function getUrl()
    {
        return '/installment/' . str_replace(' ', '-', $this->title);
    }

}

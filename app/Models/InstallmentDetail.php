<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallmentDetail extends Model
{
    protected $fillable = ['date_collection','collection_value','note','parent_installment_id'];

    protected $guarded = ['id'];

    static $cacheKey = 'installmentdetails';
}

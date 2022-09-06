<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskFmeaSubDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'sub_device_number',
        'sub_device_name',
        'sub_device_action',
        'sub_device_spec',
        'failure_mode',
        'failure_reason',
        'failure_affect',
        'protect_engineering',
        'protect_manage',
        'protect_personal',
        'before_category',
        'before_s',
        'before_p',
        'before_level',
        'reduce_risk',
        'after_s',
        'after_p',
        'after_level',
        'sort_num',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskHazopSubDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'node',
        'cover_device',
        'node_description',
        'process_deviation',
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

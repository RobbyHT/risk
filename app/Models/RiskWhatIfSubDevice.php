<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskWhatIfSubDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'description',
        'in_case',
        'hazard_type',
        'consequences',
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

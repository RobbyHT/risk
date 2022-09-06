<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskJsaContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_id',
        'action',
        'description',
        'inaccurate',
        'affect',
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

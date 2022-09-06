<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskJsaSubTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_id',
        'sub_title',
        'sort_num',
    ];
}

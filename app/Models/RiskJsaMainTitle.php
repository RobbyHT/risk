<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskJsaMainTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'main_title',
        'sort_num',
    ];
}

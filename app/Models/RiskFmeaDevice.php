<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskFmeaDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_name',
    ];
}

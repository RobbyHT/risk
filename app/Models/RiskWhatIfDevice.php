<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskWhatIfDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_name',
    ];
}

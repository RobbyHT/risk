<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceExamItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function device()
    {
        return $this->belongsTo(DeviceExamItem::class);
    }
}

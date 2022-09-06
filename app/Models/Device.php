<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function exam_items()
    {
        return $this->hasMany(DeviceExamItem::class);
    }

    public function region()
    {
        return $this->belongsTo(DeviceRegion::class);
    }
}

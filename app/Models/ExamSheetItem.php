<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamSheetItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function sheet()
    {
        return $this->belongsTo(ExamSheet::class);
    }

    public function exam_item()
    {
        return $this->hasOne(DeviceExamItem::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamSheet extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function sheet_items()
    {
        return $this->hasMany(ExamSheetItem::class);
    }
}
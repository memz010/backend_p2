<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id' ,
        'exam_date' ,
    ];

    public function school()
    {
        return $this->belongsTo(School::class) ;
    }

}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id' ,
         'exam_id' ,
         'grade' ,
    ];
    public function students()
    {
        return $this->belongsToMany(User::class ,'grades') ;
    }
    public function exams()
    {
        return $this->belongsToMany(Exam::class ,'grades') ;
    }

}

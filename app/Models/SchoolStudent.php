<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolStudent extends Model
{
    use HasFactory;
        protected $fillable = [
        'school_id' ,
        'student_id' ,
    ];
    public function schools()
    {
        return $this->belongsToMany(School::class ,'school_students') ;
    }
    public function users()
    {
        return $this->belongsToMany(User::class ,'school_students') ;
    }
}



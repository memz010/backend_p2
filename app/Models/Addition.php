<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addition extends Model
{
    use HasFactory;
    protected $fillable = [
        'school_id' ,
        'student_id' ,
        'information_request' ,
    ];
    public function schools()
    {
        return $this->belongsToMany(School::class ,'additions') ;
    }
    public function students()
    {
        return $this->belongsToMany(User::class ,'additions') ;
    }
}

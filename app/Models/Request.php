<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $fillable = [
        'school_id' ,
        'student_id' ,
        'information_request' ,
    ];
    public function schools()
    {
        return $this->belongsToMany(School::class ,'requests') ;
    }
    public function students()
    {
        return $this->belongsToMany(User::class ,'requests') ;
    }

}

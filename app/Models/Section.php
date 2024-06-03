<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id' ,
         'stage_id' ,
         'count_of_student' ,
         'number_of_section'
    ];
    public function students()
    {
        return $this->belongsToMany(User::class ,'sections') ;
    }
    public function stages()
    {
        return $this->belongsToMany(Stage::class ,'sections') ;
    }

}

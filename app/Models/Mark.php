<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id' ,
        'submission_id' ,
        'mark',
        'note' ,
    ];
    public function submission()
    {
        return $this->belongsToMany(Submission::class ,'marks') ;
    }
    public function students()
    {
        return $this->belongsToMany(User::class,'marks');
    }

}

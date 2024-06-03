<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id' ,
        'title' ,
        'uploaded_date' ,
        'deadline',
        'start_of_submissions_date',
        'description',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class) ;
    }
    public function submissions()
    {
        return $this->hasMany(Submission::class) ;
    }
}

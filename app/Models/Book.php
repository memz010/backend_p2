<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id' ,
        'book_id' ,
        'assosiation_level',

    ];

    public function subject()
    {
        return $this->belongsToMany(Subject::class,'books') ;
    }
    public function books()
    {
        return $this->belongsToMany(Library_Book::class,'books') ;
    }
}

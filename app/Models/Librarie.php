<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Librarie extends Model
{
    use HasFactory;
    protected $fillable = [
        'school_id' ,
        'description' ,
        'type' ,
    ];

    public function school()
    {
        return $this->belongsTo(School::class) ;
    }
    public function Library_Book()
    {
        return $this->hasMany(Library_Book::class) ;
    }


}

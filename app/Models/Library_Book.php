<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library_Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'library_id' ,
        'name' ,
        'description',
        'author' ,
        'type',
        'pages',
    ];

    public function Librarie()
    {
        return $this->belongsTo(Librarie::class) ;
    }



}

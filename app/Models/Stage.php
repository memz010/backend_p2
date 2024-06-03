<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;
    protected $fillable = [
        'school_id' ,
         'name' ,
    ];
    public function school()
    {
        return $this->belongsTo(School::class) ;
    }
    public function subjects()
    {
        return $this->hasMany(Subject::class) ;
    }

}

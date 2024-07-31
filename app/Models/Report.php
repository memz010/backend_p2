<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'report' ,
        'user_id',
        'school_id',
    ];
    public function schools()
    {
        return $this->belongsToMany(School::class ,'reports') ;
    }
    public function users()
    {
        return $this->belongsToMany(User::class ,'reports') ;
    }
}

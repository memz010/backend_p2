<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_stage' ,
        'name' ,
        'semester',
        'lectuer_per_week',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class) ;
    }
    public function stage()
    {
        return $this->belongsTo(Stage::class) ;
    }


}

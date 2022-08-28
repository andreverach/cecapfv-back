<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'dia',
        'turno',
        'start_time',
        'end_time',
        'active',        
        'created_at',        
        'updated_at',
    ];

    public $timestamps = true;
}

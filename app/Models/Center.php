<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'active',
        'created_at',
        'updated_at',        
    ];

    public $timestamps = true;
}

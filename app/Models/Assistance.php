<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistance extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'attend',
        'active',
        'created_at',        
        'updated_at',        
        'person_id',   
        'classroom_id',
    ];
    public $timestamps = true;
    //relations
    public function person(){
        return $this->belongsTo(Person::class);
    }
    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
}

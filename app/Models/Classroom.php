<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable = [
        'active',
        'created_at',
        'updated_at',
        'schedule_id',        
        'course_id',        
        'center_id',   
        'person_id',
    ];

    public $timestamps = true;
    //relationchips
    public function schedule(){
        return $this->belongsTo(Schedule::class);
    }
    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function center(){
        return $this->belongsTo(Center::class);
    }
    public function person(){
        return $this->belongsTo(Person::class);
    }
}

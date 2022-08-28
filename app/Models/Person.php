<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'persons';
    protected $fillable = [
        'firstName',
        'lastName',
        'phone',
        'birthdate',        
        'dni',        
        'parent',   
        'active',
        'person_type_id',
        'school',
        'created_at',
        'updated_at',        
    ];
    public $timestamps = true;

    //queries scope
    public function scopeLastName($query, $lastName){
        if($lastName)
            return $query->where('lastName', 'LIKE', "%$lastName%");
    }

    //relationchips
    public function his_school(){
        return $this->belongsTo(School::class, 'school');
    }
    public function his_parent(){
        return $this->belongsTo(Person::class, 'parent');
    }
    public function person_type(){
        return $this->belongsTo(PersonType::class);
    }
}


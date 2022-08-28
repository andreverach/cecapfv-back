<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonClassroom extends Model
{
    protected $table = 'person_classroom';
    use HasFactory;
    protected $fillable = [
        'active',
        'created_at',
        'updated_at',
        'person_id',        
        'classroom_id',              
    ];
    public $timestamps = true;

    //queries scope
    public function scopeStudenAssign($query, $lastName){//el person es el nombre de la relacion y luego es persons. por el nombre de la tabla
        if($lastName)
            return $query->whereHas('person', function ($query) use ($lastName) {
                $query->where('persons.lastName', 'LIKE', "%$lastName%");
            });
            //return $query->where('lastName', 'LIKE', "%$lastName%");
    }

    //relations
    public function person(){//->orderBy('lastName');
        return $this->belongsTo(Person::class);
    }
    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
}

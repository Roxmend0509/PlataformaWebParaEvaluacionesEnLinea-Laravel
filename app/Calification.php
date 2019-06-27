<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Examen;

class Calification extends Model
{
    protected $fillable = [
        'calificacion', 'aprobation','user_id','examen_id'
    ];

    public function examenes(){
        return $this->hasMany('App\Examen','id','examen_id');
    }

    public function makes()
    {
        return $this->hasMany('App\ExamStudentAsociados', 'user_id');
    }

    public function calificaciones()
    {
    return $this->hasMany('App\Calification','id','examen_id');
    }


}

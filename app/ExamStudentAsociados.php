<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Examen;

class ExamStudentAsociados extends Model
{
    protected $fillable = [ 'examen_id', 'user_id','complete'];

    public function examenes()
    {
    return $this->hasMany('App\Examen','id','examen_id');
    }

    public function users()
    {
    return $this->hasMany('App\ExamStudentAsociados','id','examen_id');
    }

    public function calificaciones()
    {
    return $this->hasMany('App\Calification','user_id','user_id');
    }
}

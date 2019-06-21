<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Respuesta;
use App\Pregunta;
use App\ClaveExamen; 

class Examen extends Model
{
    protected $fillable = [ 'name','description', 'key', 'duration' ];

    

    public function preguntas()
    {
        return $this->hasMany('App\Pregunta','examen_id');
    }
    
    public function respuestas()
    {
    return $this->hasMany('App\Respuesta','question_id');
    }
    public function respuesta()
    {
    return $this->hasMany('App\Respuesta','AnswerCorrect');
    }

    public function calificaciones()
    {
    return $this->hasMany('App\Calification','examen_id');
    }


}



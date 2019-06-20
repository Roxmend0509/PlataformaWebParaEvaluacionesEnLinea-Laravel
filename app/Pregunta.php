<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Respuesta;
use App\ClaveExamen;

class Pregunta extends Model
{
    protected $fillable = [ 'textquestion', 'examen_id'];


    public function preguntas()
    {
    return $this->hasMany('App\Pregunta','examen_id');
    }

    public function respuestas()
    {
    return $this->hasMany('App\Respuesta','question_id');
    }


}


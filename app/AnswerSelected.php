<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ExamenStudentAsociados;

class AnswerSelected extends Model
{
    protected $fillable = [ 'question_id','answer_id','exam_student_id'];

    public function respuestas()
    {
    return $this->hasMany('App\Respuesta','id','answer_id');
    }

    
  

    



    
}

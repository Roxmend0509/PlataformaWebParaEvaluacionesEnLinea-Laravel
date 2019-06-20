<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\AnswerSelected;
use App\ExamStudentAsociados;
use App\Calification;
use App\Examen;

class AnswerSelectedController extends Controller
{
    public function setAnswers($user, $examen, Request $request)
    {
        $examStudentAsociados = ExamStudentAsociados::where('examen_id', $examen)
        ->where('user_id', $user)
        ->first();

        foreach ($request->respuestas as $key => $value) {
            AnswerSelected::create([
                "answer_id" => $value['respuesta'],
                "question_id" => $value['pregunta'],
                "exam_student_id" => $examStudentAsociados->id
            ]);
            
        }

        $cantidadPreguntas = AnswerSelected::where('exam_student_id',$examStudentAsociados->id)->count();

        $respuetasCorrectas = AnswerSelected::where('exam_student_id',$examStudentAsociados->id)->
        whereHas('respuestas', function($query){
            $query->where('AnswerCorrect', 'CORRECTA');})->count();
        
        Calification::create([
            'calificacion' => $respuetasCorrectas,
            'aprobation' => $cantidadPreguntas / 2 >= $respuetasCorrectas 
                ? 'NO APROBADO'
                : 'APROBADO',
            'user_id' => $user,
            'examen_id' => $examen,

        ]);

        $student=ExamStudentAsociados::where('examen_id', $examen)->first();
        $student->complete ="REALIZADO";
        $student->save();

    }


    public function getCalificacionExamen($user,$examen){
            $calificacion=Calification::where('examen_id',$examen)
            ->where('user_id',$user)
            ->get();
            
            return json_encode($calificacion);
    }

    public function getCalificacionExamenAlu($idAlu){
        $calificacion=Calification::where('user_id',$idAlu)->with('examenes')->get();
        return json_encode($calificacion);
}
}
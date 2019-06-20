<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Respuesta;
use App\Examen;
use App\Pregunta;

class RespuestaController extends Controller
{
    public function index(){
        $respuestas=Respuesta::get();
        echo json_encode($respuestas);
    }

    public function getRespuestas($id){
        $respuesta=Respuesta::where('question_id',$id)->get();
        return json_encode($respuesta);
    }
    
    public function store(Request $request){
        $respuesta=new Respuesta();
        $respuesta->textanswer = $request->input('textanswer');
        $respuesta->question_id = $request->input('question_id');
        $respuesta->AnswerCorrect = $request->input('AnswerCorrect');
        $respuesta->save();
        echo json_encode($respuesta);
    }

    public function update(Request $request,$respuesta_id){
        $respuesta=Respuesta::find($respuesta_id);
        $respuesta->textanswer = $request->input('textanswer');
        $respuesta->AnswerCorrect = $request->input('AnswerCorrect');
        $respuesta->save();
        echo json_encode($respuesta);
    }

    public function destroy(Request $request,$respuesta_id){
        $respuesta=Respuesta::find($respuesta_id);
        $respuesta->delete();
}

}

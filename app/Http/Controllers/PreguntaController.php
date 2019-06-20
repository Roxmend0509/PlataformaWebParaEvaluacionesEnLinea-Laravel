<?php

namespace App\Http\Controllers;
use App\Pregunta;
use App\Respuesta;
use DB;


use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    
    public function index(){
        $preguntas=Pregunta::get();
        echo json_encode($preguntas);
    }
    

    public function getPreguntas($id){
        $pregunta=Pregunta::where('examen_id',$id)->get();
        return json_encode($pregunta);
    }


    public function store(Request $request){
        $pregunta=new Pregunta();
        $pregunta->textquestion = $request->input('textquestion');
        $pregunta->examen_id = $request->input('examen_id');
        $pregunta->save();
        echo json_encode($pregunta);
    }

    public function update(Request $request,$pregunta_id){
    
        $pregunta=Pregunta::find($pregunta_id);
        $pregunta->textquestion = $request->input('textquestion');
        $pregunta->save();
        echo json_encode($pregunta);
    }

    public function destroy(Request $request,$pregunta_id){
      
        $pregunta=Pregunta::find($pregunta_id);
        $pregunta->delete();
}


}

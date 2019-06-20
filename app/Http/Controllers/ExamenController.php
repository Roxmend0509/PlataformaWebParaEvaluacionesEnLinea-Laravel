<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Examen;
use App\Pregunta;
use App\Respuesta;
use Illuminate\Database\Query\Builder;
use DB; 

class ExamenController extends Controller
{
    public function index(){
        $examen=Examen::get();
        echo json_encode($examen);
     }
 
     public function store(Request $request){
         $exam=new Examen();
         $exam->name = $request->input('name');
         $exam->description = $request->input('description');
         $exam->key = $request->input('key');
         $exam->duration = $request->input('duration');
         $exam->save();
         echo json_encode($exam);
     }

     public function update(Request $request,$examen_id){
    
        $exam=Examen::find($examen_id);
        $exam->name = $request->input('name');
        $exam->description=$request->input('description');
        $exam->key = $request->input('key');
        $exam->duration = $request->input('duration');
        $exam->save();
        echo json_encode($exam);
    }

    public function destroy($examen_id){
      
        $exam=Examen::find($examen_id);
        $exam->delete();
}


public function getExamen($id){
    $examen=Examen::where('id',$id)->get();
    return json_encode($examen);
}

public function getExamenCompleto($id){
    $examen=Examen::where('id',$id)->with('preguntas.respuestas')->first();
    return json_encode($examen);
}

public function getClavesExamen($id){
    $examen=Examen::where('id',$id)->first();
    $respuestas=$examen->respuestas;
    return json_encode($examen);
}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Examen;
use App\User;
use App\Respuesta;
use Illuminate\Database\Query\Builder;
use DB; 
use App\ExamStudentAsociados;
use App\Calification;

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

public function updateAl(Request $request,$user_id){
    $user=User::find($user_id);
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->save();
    echo json_encode($user);
}

public function getExamWithCal($id){
    $examenes = ExamStudentAsociados::where('user_id', $id)->pluck('examen_id');
    $calificaciones = Calification::with('examenes')
        ->where('user_id', $id)
        ->whereIn('examen_id', $examenes)
        ->get();
        
    return json_encode($calificaciones);
}

public function search($email){
    $user = User::where('email', 'like', "%$email%")->get();
    return json_encode($user);
}
}

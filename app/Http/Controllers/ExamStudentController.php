<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ExamStudentAsociados;
use App\Examen;


class ExamStudentController extends Controller
{
    public function index(){
        $students=ExamStudentAsociados::get();
        echo json_encode($students);
     }

     public function getExams($id){
        $pendientes=ExamStudentAsociados::select(['examen_id'])
        ->where('user_id', $id)
        ->where('complete', 'NO REALIZADO')
        ->get();
        $exams = Examen::whereIn('id', $pendientes)->get();
        return json_encode($exams);
    }

 
     public function store(Request $request){
         $student=new ExamStudentAsociados();
         $student->examen_id = $request->input('examen_id');
         $student->user_id = $request->input('user_id');
         $student->save();
         echo json_encode($student);
     }
 
     public function update(Request $request,$user_id){
         $student=ExamStudentAsociados::find($user_id);
         $student->complete = "REALIZADO";
         $student->save();
         echo json_encode($student);
     }
 
     public function destroy(Request $request,$user_id){
         $student=ExamStudentAsociados::find($user_id);
         $student->delete();
 }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClaveExamen;

class ClaveExamenController extends Controller
{
    public function index(){
        $keys=ClaveExamen::get();
        echo json_encode($keys);
     }
     public function getClave($id){
        $key=ClaveExamen::where('question_id',$id)->get();
        return json_encode($key);
    }

     public function store(Request $request){
        $key=new ClaveExamen();
        $key->question_id = $request->input('question_id');
        $key->answer_id = $request->input('answer_id');
        $key->save();
        echo json_encode($key);
    }

    public function update(Request $request,$key_id){
        $key=ClaveExamen::find($key_id);
        $key->question_id = $request->input('question_id');
        $key->answer_id = $request->input('answer_id');
        $key->save();
       echo json_encode($key);
   }

   public function destroy(Request $request,$key_id){
       $key=ClaveExamen::find($key_id);
       $key->delete();
}
}

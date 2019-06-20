<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CalificationController extends Controller
{
    public function getStudent($id){
        $users= User::where('id',$id)->get();
        echo json_encode($users);
     }

}

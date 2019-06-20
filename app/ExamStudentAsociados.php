<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Examen;

class ExamStudentAsociados extends Model
{
    protected $fillable = [ 'examen_id', 'user_id','complete'];

    public function exams()
    {
    return $this->hasMany('App\Examen','id','examen_id');
    }

    public function users()
    {
    return $this->hasMany('App\User','id','user_id');
    }
}

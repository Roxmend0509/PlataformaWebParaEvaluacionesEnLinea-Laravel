<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('students','StudentsController');
Route::resource('exams','ExamenController');
Route::resource('questions','PreguntaController');
Route::resource('answers','RespuestaController');
Route::resource('examStudent','ExamStudentController');
Route::resource('claveQuestion','ClaveExamenController');
Route::get('examen/{id}','ExamenController@getExamen');
Route::get('ExaWithCal/{id}','ExamenController@getExamWithCal');
Route::get('examenes/{id}','ExamenController@getExamenCompleto');
Route::get('search/{email}','ExamenController@search');
Route::get('question/{id}','PreguntaController@getPreguntas');
Route::get('questiones/{id}','PreguntaController@getPregunta');
Route::get('answer/{id}','RespuestaController@getRespuestas');
Route::get('ans/{id}','PreguntaController@getCorrecta');
Route::get('student/{id}','CalificationController@getStudent');
Route::get('clave/{id}','ClaveExamenController@getClave');
Route::post('register', 'Api\AuthController@register');
Route::get('examUser/{id}', 'ExamStudentController@getExams');
Route::put('user/{id}', 'ExamenController@updateAl');


Route::post('setAnswers/{user}/{examen}', 'AnswerSelectedController@setAnswers');
Route::get('CalificacionExamen/{user}/{examen}', 'AnswerSelectedController@getCalificacionExamen');
Route::get('CalificacionExamenAlu/{user}', 'AnswerSelectedController@getCalificacionExamenAlu');

Route::group([

    'middleware' => 'api',
    'middleware' => 'cors',

], function ($router) {
    Route::get('user', 'AuthController@index');
    Route::delete('deleteUser/{id}','AuthController@destroy');
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('sendPasswordResetLink','ResetPasswordController@sendEmail');
    Route::post('resetPassword','ChangePasswordController@process');
    
    
});
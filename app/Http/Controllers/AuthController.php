<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function index(){
        $users= User::where('role', '=', 'STUDENT')->get();
        echo json_encode($users);
     }

     public function update(Request $request,$user_id){
        $user=User::find($user_id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        echo json_encode($user);
    }
     
     public function destroy(Request $request,$user_id){
        $user=User::find($user_id);
        $user->delete();
}

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','destroy','login','signup']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Email or password does\'t exist'], 401);
        }
       // return $this->respondWithToken($token);

      $user = User::where( ['email' => $credentials['email'] ] )->first();
        $user->token = $token;
        $user->save();
     return json_encode( ["token" => $token, "user" => auth()->user(),"id"=>auth()->id()] );
        
    }

    public function signup(SignUpRequest $request){
        User::create($request->all());
        return $this->login($request);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()->name
        ]);
    }

    public function getExams($id){
       // $user=DB::table('')('id',$id)->get();
        echo json_encode($user);

        $user = DB::table('exam_student_asociados')
                ->join('examens', 'exam_student_asociados.examen_id', '=', 'id')
                ->join('users', 'exam_student_asociados.user_id', '=', $id)
                ->get();
                echo json_encode($user);
        //return $request->header('Authorization');
        //$user = User::where( 'token',($request->header('Authorization')) )->get();
        // $exams = $user->exams;
        //return json_encode( $exams );

    }

    
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\User;
use App\Grant;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request){
        if($request->user()->tokenCan('user:perfil')){
            return response()->json(['perfil'=>$request->user()], 200);
        }
        return abort(401, 'Scope invalido');
    }

    public function logIn(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $user = User::where('email',$request->email)->first();

        if(! $user || ! Hash::check($request->password, $user->password)){
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }

        $abilities = array();
        $grants = Grant::where('user_id', $user->id)->get();
        foreach ($grants as $grant) {
            array_push($abilities, $grant->abilities);
        }

        $token = $user->createToken($request->email, $abilities)->plainTextToken;
        return response()->json(['token'=>$token], 201);
    }

    public function logOut(Request $request){
        return response()->json(['afectados'=>$request->user()->tokens()->delete()], 200);
    }

    public function signIn(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
            'name'=>'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            return response()->json($user, 201);
        }
        return abort(400, 'Error al generar el registro');
    }

}

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

    public function grant(Request $request, $id, $ab){
        $abilitie = '';
        switch ($ab) {
            case 'e':
                $abilitie = 'user:edit';
                break;
            case 's':
                $abilitie = 'user:info';
                break;
            case 'd':
                $abilitie = 'user:delete';
                break;
            case 'p':
                $abilitie = 'user:perfil';
                break;
            default:
                return response()->json(['Error'=>'Permiso no encontrado'], 406);
                break;
        }
        $grant = Grant::create([
            'user_id'=>$id,
            'abilities'=>$abilitie
        ]);
        return response()->json(['Grant establecido' => $grant, 'Usuario'=>$grant->user()->get()], 201);
    }

    public function revoke(Request $request, $id, $ab){
        $user = User::findOrFail($id);
        $grants = $user->grants();
        $abilitie = '';
        switch ($ab) {
            case 'e':
                $abilitie = 'user:edit';
                break;
            case 's':
                $abilitie = 'user:info';
                break;
            case 'd':
                $abilitie = 'user:delete';
                break;
            case 'p':
                $abilitie = 'user:perfil';
                break;
            default:
                return response()->json(['Error'=>'Permiso no encontrado'], 406);
                break;
        }
        $grants->where('abilities', $abilitie)->delete();
        return response()->json(['User'=>$user, 'Revoke'=>$abilitie], 201);
    }

}

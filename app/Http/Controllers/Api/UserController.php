<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    function login(Request $request) {
        $validator = validator()->make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        $credentials = $validator->validated();
       
        if(Auth::attempt($credentials)){
            // session()->regenerate(); // SPA con COOKIE
            // return response()->json('Successful authentication'); // SPA con COOKIE
            // dd(Auth::user()->createToken('myapptoken'));
            $user = Auth::user();
            if (!$user instanceof User) {
                return response()->json('Invalid credentials',401);
            }
            $token = $user->createToken('myapptoken')->plainTextToken;
            return response()->json($token);
            
        }else{
            return response()->json('Invalid credentials',401);
        }
        
    }
    function logout(Request $request)  {
       // Eliminamos el token que está usando el usuario en esta petición
        $request->user()->currentAccessToken()->delete();
                return response()->json(['message' => 'Token eliminado correctamente'], 204);
    }
}

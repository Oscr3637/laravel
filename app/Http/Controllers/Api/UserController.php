<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    function login(Request $request) {
        $validator = validator()->make($request->all(), ["email" =>
            'required', 'email',
            'password' => 'required'
        ]);  
        if($validator->fails()){
            //return $validator->errors();
            return response()->json($validator->errors(),422);
        }
        $credentials = $validator->validated();
       
        //    if(auth()->attempt($credentials)){
 
           if(Auth::attempt($credentials)){
            session()->regenerate(); // SPA con COOKIE
            return response()->json('Successful authentication'); // SPA con COOKIE
            
        }else{
            return response()->json('Invalid credentials',401);
        }
        
    }
}
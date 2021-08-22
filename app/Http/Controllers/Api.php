<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class Api extends Controller
{
    //PASSPOSRT LOGIN & REGISTRATION
    
    //registration
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'email'=> 'required|email',
            'password'=>'required',
            'c_password'=>'required|same:password'
        ]);
        if($validator->fails()){
            return response()->json([$validator->errors()], 202);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $responseArray = [];
        $responseArray['token'] = $user->createToken('MyApp')->accessToken;
        $responseArray['name'] = $user->name;

        return response()->json($responseArray,200);
    }

    ///   login ///

    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            $user = Auth::user();
            $responseArray = [];
            $responseArray['token'] = $user->createToken('MyApp')->accessToken;
            $responseArray['name'] = $user->name;
    
            return response()->json($responseArray,200);
        }else{
            return response()->json(['error=>Unauthorized'],203);
        }
    }
    //view call by api
    public function view(){
        return view('view');
    }
}

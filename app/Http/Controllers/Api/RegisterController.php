<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use App\Models\User as User;


class RegisterController extends Controller
{   
    private $auth;
    public function __construct()
    {
        $this->auth = new AuthController();
    }

    public function register(Request $request)
    {
        
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::create(request(['name', 'email', 'password']));

        return $this->auth->login($request);

        // if(isset($user)){
        //     return response()->json(['message' =>'Registation Successfull'], 200);
        // }
        // return response()->json(['error' => 'Please Try Again'], 401);

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Register;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\AuthController;
use App\Models\User as User;


class RegisterController extends Controller
{   
    private $auth;

    public function __construct()
    {
        $this->auth = new AuthController();
    }

    public function register(Register $request)
    {   
      
        $user = User::create(request(['name', 'email', 'password']));

        return $this->auth->login($request);

        // if(isset($user)){
        //     return response()->json(['message' =>'Registation Successfull'], 200);
        // }
        // return response()->json(['error' => 'Please Try Again'], 401);

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Register;
use App\Http\Requests\Login;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\AuthController;
use App\Repository\UserRepository;

class RegisterController extends Controller
{   
    private $auth;
    private $repository;

    public function __construct(UserRepository $repository )
    {   $this->repository = $repository;
        $this->auth = new AuthController();
    }

    public function register(Register $request)
    {   
        $user = $this->repository->create(request(['name', 'email', 'password']));
        if($user){
            $login_request = new Login(request(['email', 'password']));
            return $this->auth->login($login_request);
        }
        return response()->json(['error'=>'Something Went Wrong'],401);
        
    }
}

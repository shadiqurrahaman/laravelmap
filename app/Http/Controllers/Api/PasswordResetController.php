<?php

namespace App\Http\Controllers\Api;

use App\Services\MailService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPassword;
use App\Http\Requests\ResetPassword;
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Hash;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    private $mailService;

    public function __construct(MailService $mailService)
    {
      $this->mailService = $mailService;
    }

    public function submitForgetPasswordForm(ForgetPassword $request)
      {
        
          $token = Str::random(64);
          
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          $check = $this->mailService->sendEmail(['email'=>$request->email,'token'=>$token]);
          
          if($check){
            return response()->json(['message' => 'Mail Send'], 200);
          }
            return response()->json(['message'=>'something went wrong'],401);
     
     
      }


      public function showResetPasswordForm($token) 
      { 
        
        return view('resetPasswordForm', ['token' => $token]);
      }



     public function submitResetPasswordForm(ResetPassword $request)
      {
            
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
         return response()->json(['message'=>'password update success fully']);
      }

}

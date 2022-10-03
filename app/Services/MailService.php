<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class MailService
{
    public function sendEmail($data)
    {   
        try{

            Mail::send('email.forgetPassword', ['token' => $data['token']], function($message) use($data){
                $message->to($data['email']);
                $message->subject('Reset Password');
            });
        
        }catch(\Exception $e){
            return false;
        }
        return true;

}
<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthorForgotForm extends Component
{
    public $email;

    public function ForgotHandler(){

        $this->validate([
            'email'=>'required|email|exists:users,email'
        ],[
            'email.required'=>'Email is required',
            'email.email'=>'Invalid Email',
            'email.exists'=>'Email does not exist'
        ]);
        $token=base64_encode(Str::random(64));
        DB::table('password_reset_tokens')->insert([
            'email'=>$this->email,
            'token'=>$token,
            'created_at'=>Carbon::now()
        ]);
        $user=User::where('email',$this->email)->first();
        $link=route('author.reset-form',['token'=>$token,'email'=>$this->email]);
        $body_message="We are recived a request to reset the password for <b>Blog-Speher</b> account associatde with ". $this->email .". <br> Please click the button below to reset your password. If you did not request a password reset, please ignore this email.";
        $body_message.=".<br>";
        $body_message.="<a href='" . $link . "' target='_blank' style='color:#FFF;border: color #22bc66;border-style:solid;border-widht:10px 180px;background-color:#22bc66;display:inline-block;text-decoration:none;border-radius:3px; box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.16);-webkit-text-size-adjust:none; box-sizing: border-box;'>Reset Password</a>";
        $body_message.="<br>";
        $body_message.="If you did not request a password reset, please ignore this email.";

        $data=[
            'name'=>$user->name,
            'body_message'=>$body_message,
        ];
        Mail::send('forgot-email-template', $data, function($message) use($user){
            $message->from('noreply@example.com', 'Blog-Speher');
            $message->to($user->email, $user->name)
                    ->subject('Reset Password');
        });
        $this->email=null;
        session()->flash('success', 'We have e-mailed your password reset link!');
    }

    public function render()
    {
        return view('livewire.author-forgot-form');
    }
}

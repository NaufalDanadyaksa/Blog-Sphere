<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;

class AuthorResetForm extends Component
{

    public $email,$token,$new_password,$confirm_new_password;

    public function mount(){
        $this->email = request()->email;
        $this->token = request()->token;
    }

    public function ResetHandler(){

        $this->validate([
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required|min:5',
            'confirm_new_password' => 'same:new_password',
        ],[
            'email.exists' => 'Email does not exist.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email is not valid.',
            'new_password.required' => 'Password is required.',
            'new_password.min' => 'Password must be at least 5 characters.',
            'confirm_new_password' => 'Password does not match.',
        ]);
        $check_token=DB::table('password_reset_tokens')->where([
            'email'=>$this->email,
            'token'=>$this->token,
            ])->first();
            if (!$check_token) {
                session()->flash('fail', 'Invalid Token.');
            }else {
                User::where('email', $this->email)->update([
                    'password' => Hash::make($this->new_password),
                ]);
                DB::table('password_reset_tokens')->where([
                    'email'=>$this->email,
                ])->delete();
            }
            $success_token=Str::random(64);
            session()->flash('success', 'Password Reset Successfully. Login with your email '.$this->email.' and new password.');

            $this->redirectRoute('author.login',[
                'tkn' => $success_token,
                'UEmail' => $this->email,
            ]);
    }
    public function render()
    {
        return view('livewire.author-reset-form');
    }
}

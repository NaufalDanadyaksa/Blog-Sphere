<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthorLoginForm extends Component
{
    public $login_id, $password;
    public function LoginHandler()
    {
      $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
      if($fieldType=='email'){
        $this->validate([
            'login_id'=>'email|required|exists:users,email',
            'password'=>'required|min:5'
        ],[
            'login_id.required'=>'Email or Username is required',
            'login_id.email'=>'Invalid Email',
            'login_id.exists'=>'Email does not exist',
            'password.required'=>'Password is required',
        ]);
      }else {
        $this->validate([
            'login_id'=>'required|exists:users,username',
            'password'=>'required|min:5'
        ],[
            'login_id.required'=>'Email or Username is required',
            'login_id.exists'=>'Username does not exist',
            'password.required'=>'Password is required',
        ]);
      }

      $creds = [
        $fieldType => $this->login_id,
        'password' => $this->password
      ];
      if (Auth::guard('web')->attempt($creds)) {
        $checkUser = User::where($fieldType, $this->login_id)->first();
        if ($checkUser->blocked==1) {
            Auth::guard('web')->logout();
            return redirect()->route('author.login')->with('error', 'Your account has been blocked');
        } else {
            session()->flash('success', 'Login Successful');
            return redirect()->route('author.home');
        }
        
        
      }else{
        session()->flash('error', 'Invalid Email/Username or Password');
      }
    }
    public function render()
    {
        return view('livewire.author-login-form');
    }
}

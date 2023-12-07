<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function index(Request $request){
        return view('back.pages.home');
    }

    public function ResetForm(Request $request, $token=null){
        $data=[
        'pageTitle'=>'Reset Password',
        ];
        return view('back.pages.auth.reset',$data)->with(['token'=>$token,'email'=>$request->email]);
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('author.login');
    }
}

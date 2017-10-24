<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller{

    protected $redirectTo = '/home';
    
    public function __construct(){
        $this->middleware('guest:admin');
    }

    public function show(){
        return view('auth.adminLogin');
    }

    public function login(Request $request){
        $this->validate($request, [ 
            'password' => 'required|min:7',
            'email' => 'required|email',
        ]);

        $input = [
            'password' => $request->password,
            'email' => $request->email
        ];

        if(Auth::guard('admin')->attempt($input, $request->remember)){ //hashes automaticly
            return redirect()->intended('admin');
        }

        return redirect()->back()->with('error', 'Login Unsuccessful')->withInput($request->only('email','remember'));   
    }
}

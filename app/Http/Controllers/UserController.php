<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller{
    public function __construct(){
        if((Auth::guard('admin')->user() == null)){
            $this->middleware('auth:admin');
        }
        else{
            $this->middleware('auth');
        }
        
    }

    public function index(){
        return view('account');
    }

    public function edit($id){
        $user = User::find($id);
        return view('editAccount')->with('user', $user);
    }

    public function update(Request $request, $id){
        $this->validate($request, [ 
            'name' => 'required',
            'email' => 'required',
            'pass' => 'required'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->pass;
        $user->save();

        return view('account');
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        
        return redirect('/')->with('success', 'Your account and projects have been deleted, have a nice night.');
    }
}

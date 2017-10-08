<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller{
    private $user_id;
    private $user;

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('account')->with('user');
    }

    public function edit($id){
        return view('editAccount');
    }

    public function update(Request $request){
        $this->validate($request, [ 
            'name' => 'required',
            'email' => 'required',
            'avatar' => 'required',
        ]);

        $this->user_id = auth()->user()->id;
        $this->user = User::find($this->user_id);

        return view('account')->with('user', $this->user);
    }

    public function destroy(){
        $this->user_id = auth()->user()->id;
        $this->user = User::find($this->user_id);

        $this->user->delete();
        return redirect('/')->with('success', 'Your account and projects have been deleted, have a nice night.');
    }
}

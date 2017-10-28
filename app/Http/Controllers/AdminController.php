<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Project;
use App\User;

class AdminController extends Controller{

    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        $projects = Project::orderBy('id','desc')->get();
        $users = User::orderBy('id','desc')->get();
        return view('admin')->with('projects', $projects)->with('users', $users);
    }
}
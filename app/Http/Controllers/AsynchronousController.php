<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class AsynchronousController extends Controller{
    public function public(Request $request){
        if ($request->isMethod('post')){
            $project = Project::find($request->id);
    
            if($request->value == "true"){
                $project->public = 1;
                $project->save();
                return response()->json(['response'=>'Your project is now public!']);
            }
            else if($request->value == "false"){
                $project->public = 0;
                $project->save();
                return response()->json(['response'=>'Your project is now private.']);
            }
            else{
                return response()->json(['response'=>'My apologies, but something went wrong']);
            }
        }
    }

    public function search(Request $request){
        if ($request->isMethod('post')){
            $projects = Project::find()->where('public', 1)->where('name', 'like', '%'.$request->q.'%')->get();
            return response()->json(['response'=>$projects]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Image;

class EntranceController extends Controller{
    public function index(){
        $projects = Project::where('public', 1)->whereHas('images', function($q){
            $q->whereNotNull('url');
        })->inRandomOrder()->limit(4)->get();

        $thumbnails[] = [];

        foreach($projects as $project){
           $thumbnail = Image::where('project_id', $project->id)->first();
           $thumbnail = json_decode(json_encode($thumbnail), true);
           array_push($thumbnails, $thumbnail);   
        }

        return view('welcome')->with('projects', $projects)->with('thumbnails', $thumbnails);
    }

}

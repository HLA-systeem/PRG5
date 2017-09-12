<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
    public function getProject($id){
        $project = Project::find($id);
        return view('project', array('project' => $project));
    }
}

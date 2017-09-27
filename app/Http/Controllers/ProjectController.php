<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller{

    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$projects = Project::orderBy('id','desc')->get();
        $projects = Project::orderBy('id','desc')->paginate(8);
        return view('projects')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request, [ 
            'title' => 'required',
            'body' => 'required',
            'project_image' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('project_image')){
            
        }

        $project = new Project;
        $project->title = $request->input('title');
        $project->body = $request->input('body');
        $project->user_id = auth()->user()->id;
        $project->save();

        return redirect('/projects')->with('success', 'Project Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $project = Project::find($id);
        return view('project')->with('project', $project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $project = Project::find($id);

        if(auth()->user()->id !== $project->creator_id){
            return redirect('/projects/' + $id)->with('error', 'Unauthorized Page');
        }

        return view('editProject')->with('project', $project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        // print_r($request);exit;
        
        $this->validate($request, [ 
            'title' => 'required',
            'body' => 'required',
            'project_image' => 'image|nullable|max:1999'
        ]);

        $project = Project::find($id);
        $project->title = $request->input('title');
        $project->body = $request->input('body');
        $project->save();

        return redirect('/projects')->with('success', 'Project Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $project = Project::find($id);

        if(auth()->user()->id !== $project->creator_id){
            return redirect('/projects/' + $id)->with('error', 'Unauthorized Page');
        }

        $project->delete();

        return redirect('/projects')->with('success', 'Project Removed.');
    }
}

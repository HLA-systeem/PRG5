<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;
use App\Project;
use App\Image;

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
        return view('projects')->with('projects', $projects->images);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadRequest $request){
        $project = new Project;
        $project->title = $request->input('title');
        $project->body = $request->input('body');
        $project->user_id = auth()->user()->id;
        $project->save();

        
        if($request->hasFile('project_images')){
            foreach ($request->project_images as $project_image) {
                $image = $this->prepImage($request);

                $imageModel = new Image;
                $imageModel->project_id = $project->id;
                $imageModel->url = $image;
                $imageModel->save();
            }
        }
        else{
            $imageModel = new Image;
            $imageModel->project_id = $project->id;
            $imageModel->url = 'noImage.png';
            $imageModel->save();
            }

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

    private function prepImage($project_image){
        $image = $project_image->getClientOriginalName();
        $imageName = pathinfo($image, PATHINFO_FILENAME);
        $imageExtension = $project_image->getClientOriginalExtension();
        $image = $imageName.'_'.time().'.'.$imageExtension;
        $path = $project_image->storeAs('public/project_images', $image);
        return $image;
    }
}

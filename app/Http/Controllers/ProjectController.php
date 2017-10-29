<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UploadRequest;
use App\Project;
use App\User;
use App\Image;
use App\Tag;


class ProjectController extends Controller{

    public function __construct(){
        $this->middleware('roleCheck', ['except' => ['index', 'show']]);
    }


    public function index(){
        $projects = Project::orderBy('id','desc')->where('public', 1)->paginate(5);

        $thumbnails[] = [];

        foreach($projects as $project){
           $thumbnail = Image::where('project_id', $project->id)->first();
           $thumbnail = json_decode(json_encode($thumbnail), true);
           array_push($thumbnails, $thumbnail);   
        }
       
        return view('projects')->with('projects', $projects)->with('thumbnails', $thumbnails);
    }

    public function upload(){  
       return view('createProject');
    }
    

    public function store(UploadRequest $request){
        $project = new Project;
        $project->title = $request->input('title');
        $project->body = $request->input('body');
        $project->creator_id = auth()->user()->id;
        
        if($request->input('public') == ""){
            $project->public = 0;
        }

        $project->save();

        
        if($request->hasFile('project_images')){
            foreach($request->project_images as $project_image) {
                $image = $this->prepImage($project_image);

                $imageModel = new Image;
                $imageModel->project_id = $project->id;
                $imageModel->url = $image;
                $imageModel->save();
            }
        }
        else{
            $imageModel = new Image;
            $imageModel->project_id = $project->id;
            $imageModel->save();
            }

        if($request->input('tags')){
                $project_tags = explode(',',$request->input('tags'));
                foreach($project_tags as $project_tag){
                    echo $project_tag;
                    $tag = new Tag;
                    $tag->project_id = $project->id;
                    $tag->name = $project_tag;
                    $tag->save();
                }
            }
    

      
        $user = User::find($project->creator_id);
        if($user->level == 'normie'){
            if( (count($user->projects)) == 2) {
                $user->level = "contributor";
                $user->save();
                return redirect('/home')->with('success', 'Project Added! Also, you can now add tags to your project !');
            }
        }

        return redirect('/projects')->with('success', 'Project Added!');
    }

    public function show($id){
        $project = Project::find($id);

        if($project->public == 0){
            if(auth()->user() != ""){
                if(auth()->user()->id !== $project->creator_id){
                    return redirect('/projects')->with('error', 'This project is private');
                }
            }
            else{
                return redirect('/projects')->with('error', 'This project is private');
            }
        }

        $project->times_viewed += 1;
        $project->save();

        return view('project')->with('project', $project);
    }

    public function edit($id){
        $project = Project::find($id);

        if(Auth::guard('admin')->check() == false){
            if(auth()->user()->id !== $project->creator_id){
                return redirect('/projects/' . $id)->with('error', 'Unauthorized Page');
            }
        }

        return view('editProject')->with('project', $project);
    }

    public function update(Request $request, $id){
        $this->validate($request, [ 
            'title' => 'required',
            'body' => 'required',
        ]);


        $project = Project::find($id);
        $project->title = $request->input('title');
        $project->body = $request->input('body');

        if($request->input('public') == ""){
            $project->public = 0;
        }
        else{
            $project->public = 1;
        }

        $project->save();

        return redirect('/projects')->with('success', 'Project Updated!');
    }

    public function destroy($id){
        $project = Project::find($id);
        
        if(auth()->user()->id !== $project->creator_id){
            return redirect('/projects/' . $id)->with('error', 'Unauthorized Page');
        }

        $project->delete();

        return redirect('/home')->with('success', 'Project Removed.');
    }

    private function prepImage($project_image){
        $image = $project_image->getClientOriginalName();
        $imageName = pathinfo($image, PATHINFO_FILENAME);
        $imageExtension = $project_image->getClientOriginalExtension();
        $fileName = $imageName.'_'.time().'.'.$imageExtension;
        Storage::disk('local')->put($fileName, File::get($project_image));
        //$path = $project_image->storeAs('project_images', $image);
        return $fileName;
    }
}

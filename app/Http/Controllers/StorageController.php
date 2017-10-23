<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller{
    public function getProjectImage($fileName){
        $image = Storage::disk('local')->get($fileName);
        return new Response($image, 200);
    } 
}

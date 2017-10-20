<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsynchronousController extends Controller{
    public function public(Request $request){
        if ($request->isMethod('post')){
            return response()->json(['message'=>$request->json()]);
        }
    }
}

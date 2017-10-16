<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsynchronousController extends Controller{
    public function public(Request $request, $id, $value){
        return response()->json(['message'=>$request->input('id')]);
    }
}

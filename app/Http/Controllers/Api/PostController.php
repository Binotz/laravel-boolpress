<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    //
    public function index(){
        $data = [
            'success' => true,
            'results' => Post::paginate(6),
        ];

        return response()->json($data);
    }

    public function show($slug){

        $query = Post::where('slug','=',$slug)->with(['tags','category'])->first();
        //sistemo il link della cover
        $query['cover'] = asset('storage/' . $query['cover']);
        
        if ($query) {
            $response = $query;
            $success = true;
        } else{
            $response = [];
            $success = false;
        }

        $data = [
            'success' => $success,
            'response' => $response,
        ];

        return response()->json($data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Post;
use App\StatusPost;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(){
        return view('post.index',['posts'=>Post::paginate(15)]);
    }
    public function create(){
        return view('post.create',[
            'status_post'=>StatusPost::all()
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
           'title'=>'required',
           'featured'=>'required|image',
           'status_post_id'=>'required',
           'content'=>'required'
        ]);
        $name = Storage::put('posts', $request->file('featured'));
        $user = Auth::user();
        $post = $user->posts()->create([
            'title'=>$request->get('title'),
            'featured'=>$name,
            'status_post_id'=>$request->get('status_post_id'),
            'content'=>$request->get('content')
        ]);

        return $post;
    }
}

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

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request){
        $this->validate($request,[
           'title'=>'required',
           'featured'=>'image',
           'status_post_id'=>'required',
           'content'=>'required'
        ]);
        $user = Auth::user();
        $data = [];
        if($request->hasFile('featured')){
            $name = $request->file('featured')->store('public/posts');
            $data = [
                'title'=>$request->get('title'),
                'featured'=>$name,
                'status_post_id'=>$request->get('status_post_id'),
                'content'=>$request->get('content')
            ];
        }else{
            $data = [
                'title'=>$request->get('title'),
                'status_post_id'=>$request->get('status_post_id'),
                'content'=>$request->get('content')
            ];
        }
        $post = $user->posts()->create($data);
        return $post;
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return Post
     */
    public function update(Request $request,Post $post){
        $this->validate($request,[
            'title'=>'required',
            'featured'=>'image',
            'status_post_id'=>'required',
            'content'=>'required'
        ]);
        $post->fill($request->all());
        if($request->hasFile('featured')){
            Storage::delete($post->featured);
            $post->featured = $request->file('featured')->store('public/posts');
        }
        $post->save();
        return $post;
    }

    /**
     * @param Post $post
     * @return mixed
     */
    public function edit(Post $post){
        return view('post.edit',['status_post'=>StatusPost::all(),'post'=>$post]);
    }

    public function show(Post $post){
        return view('post.view',['post'=>$post]);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return $post;
    }
}

<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return view('post.index',['posts'=>Post::paginate(15)]);
    }
    public function create(){
        return view('post.create');
    }
}

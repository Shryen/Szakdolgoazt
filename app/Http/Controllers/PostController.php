<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth; 


class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->paginate(10);
        return view('post.index', compact('posts'));
    }

    public function create(){
        return view('post.create');
    }

    public function store(PostRequest $PostRequest){
        
        $post = $PostRequest->user()->posts()->create($PostRequest->validated());

        return redirect('/hirfolyam')->with(['success' => 'Hír sikeresen létrehozva']);
    }
}

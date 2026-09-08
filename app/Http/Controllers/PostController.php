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
        $posts = Post::with('author')->latest()->paginate(10); // eager loading, n+1 problémára megoldás így nem történik + egy query amikor posztokat kérdezünk le
        return view('post.index', compact('posts'));
    }

    public function create(){
        return view('post.create');
    }

    public function show(Post $post){
        $post->load('author'); // eager loading, megint csak így az author_id-n keresztül el tudjuk érni $post->author->first_name (author = user)
        return view('post.show', compact('post'));
    }

    public function store(PostRequest $postRequest){

        $post = $postRequest->user()->posts()->create($postRequest->validated());

        return redirect('/hirfolyam')->with(['success' => 'Hír sikeresen létrehozva']);
    }

    public function edit(Post $post){
        $post->load('author');
        return view('post.edit', compact('post'));
    }

    public function update(Post $post, PostRequest $postRequest){
        $isAuthor = $post->author_id === auth()->id();
        $isAdmin = auth()->user()?->role === 'admin';
        // Ha nem mi voltunk a feltöltő vagy nem vagyunk adminok forbidden 
        abort_if(! $isAuthor && ! $isAdmin, 403); 

        $post->update($postRequest->validated());   
        return redirect('/hirfolyam/'.$post->id)->with(['success' => "Poszt szerkesztése sikeres volt."]);
    }

    public function destroy(Post $post){
        $isAuthor = $post->author_id === auth()->id();
        $isAdmin = auth()->user()?->role === 'admin';
        // Ha nem mi voltunk a feltöltő vagy nem vagyunk adminok forbidden 
        abort_if(! $isAuthor && ! $isAdmin, 403); 

        $post->delete($post);
        return redirect('/hirfolyam')->with(['success' => "Poszt törlése sikeres volt."]);
    }
}

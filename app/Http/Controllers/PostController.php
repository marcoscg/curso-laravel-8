<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Http\Requests\StoreUpdatePost;

class PostController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * 
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * 
     */
    public function store(StoreUpdatePost $request)
    {
        $post = Post::create($request->all());    
        
        return redirect()->route('posts.index')->with('message', 'Post creado com sucesso!');;
        
    }

    /**
     * 
     */
    public function show($id)
    {
        if(!$post = Post::find($id))
            return redirect()->route('posts.index');

        return view('admin.posts.show', compact('post'));

    }    


    /**
     * 
     */
    public function destroy($id)
    {
        if(!$post = Post::find($id))
            return redirect()->route('posts.index');

        $post->delete();

        return redirect()->route('posts.index')->with('message', 'Post deletado com sucesso!');
    } 
    
    /**
     * 
     */
    public function edit($id)
    {
        if(!$post = Post::find($id))
            return redirect()->route('posts.index');

        return view('admin.posts.edit', compact('post'));

    }

    /**
     * 
     */
    public function update(StoreUpdatePost $request, $id)
    {
        if(!$post = Post::find($id))
            return redirect()->route('posts.index');

        $post->update($request->all());

        return redirect()->route('posts.index')->with('message', 'Post atualizado com sucesso!');

    } 

    /**
     * 
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        
        $posts = Post::where('title', 'LIKE', "%{$request->search}%")->orWhere('content', 'LIKE', "%{$request->search}%")->paginate();

        return view('admin.posts.index', compact('posts', 'filters'));
    }    
}

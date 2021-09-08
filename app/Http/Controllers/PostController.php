<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\Post;
use App\Http\Requests\StoreUpdatePost;


class PostController extends Controller
{
    /**
     * 
     */
    public function __construct()
    {
        $this->middleware('auth:web');  
    }

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
        $data = $request->all();
        
        if ($request->image->isValid()) {
            
            $nameFile = Str::of($request->title)->slug('-') . '.' . $request->image->getClientOriginalExtension();

            $file = $request->image->storeAs('posts', $nameFile);
            
            $data['image'] = $file;

        }
        
        $post = Post::create($data);
        
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

        if (Storage::exists($post->image))
            Storage::delete($post->image);

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

        $data = $request->all();
    
        if ($request->image && $request->image->isValid()) {
            
            if (Storage::exists($post->image))
                Storage::delete($post->image);
            
            $nameFile = Str::of($request->title)->slug('-') . '.' . $request->image->getClientOriginalExtension();

            $file = $request->image->storeAs('posts', $nameFile);
            
            $data['image'] = $file;

        }

        $post->update($data);

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

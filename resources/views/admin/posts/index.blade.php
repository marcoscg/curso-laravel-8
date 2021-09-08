@extends('admin.layouts.app')

@section('title', 'Listagem')    

@section('content')

    <h1>Posts</h1>    

    <a type="button" class="btn btn-primary" href="{{ route('posts.create') }}">Criar Novo Post</a>
    <hr>
    @if (session('message'))        
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{  session('message')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>     
    @endif    

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Título</th>
            <th scope="col">Conteudo</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td><img src="{{ url("storage/{$post->image}") }}" style="width: 100px;"></td>
                    <td>{{ $post->title }} </td>
                    <td>{{ $post->content }} </td>
                    <td>                [ <a href="{{ route('posts.show', $post->id) }}"> Ver </a>]
                        [ <a href="{{ route('posts.edit', $post->id) }}"> Editar </a>]</td>
                </tr>
            @endforeach            

        </tbody>
    </table>

    <form method="post" action="{{ route('posts.search') }}">    
        @csrf
        <input type="text" name="search" placeholder="Filtrar" value="{{ old('search') }}">
        <button type="submit"> Filtrar</button>
    </form>



    <hr>

    @if (isset($filters))
        {{ $posts->appends($filters)->links() }}    
    @else
        {{ $posts->links() }}    
    @endif
    
@endsection



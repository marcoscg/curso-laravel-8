@extends('admin.layouts.app')

@section('title', 'Listagem')    

@section('content')

    <a href="{{ route('posts.create') }}">Criar Novo Post</a>

    <hr>

    @if (session('message'))
        {{  session('message')}}
    @endif

    <h1>Posts</h1>

    <form method="post" action="{{ route('posts.search') }}">    
        @csrf
        <input type="text" name="search" placeholder="Filtrar" value="{{ old('search') }}">
        <button type="submit"> Filtrar</button>
    </form>

    @foreach ($posts as $post)
        <p> 
            {{ $post->title }} 
            [ <a href="{{ route('posts.show', $post->id) }}"> Ver </a>]
            [ <a href="{{ route('posts.edit', $post->id) }}"> Editar </a>]
        </p>    
    @endforeach

    <hr>

    @if (isset($filters))
        {{ $posts->appends($filters)->links() }}    
    @else
        {{ $posts->links() }}    
    @endif
    
@endsection



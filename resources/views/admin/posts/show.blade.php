@extends('admin.layouts.app')

@section('title', 'Show')    

@section('content')

    <h1>Detable do Post</h1>

    <ul>
        <li>Título:  {{ $post->title }} </li>
        <li>Contéudo:  {{ $post->conteudo }} </li>
        <img src="{{ url("storage/{$post->image}") }}" style="width: 100px;">
    </ul>

    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit">Deletar o Post</button>
    </form>

@endsection
@extends('admin.layouts.app')

@section('title', 'Editar')    

@section('content')

    <h1>Editar Post</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post" action="{{ route('posts.update', $post->id) }}">

        @method('put')

        @include('admin.posts.form')
        
        <button type="submit">Enviar</button>
        
    </form>

@endsection
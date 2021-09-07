@extends('admin.layouts.app')

@section('title', 'Novo')    

@section('content')

    <h1>Novo Post</h1>

    <form method="post" action="{{ route('posts.store') }}">

        @include('admin.posts.form')

        <button type="submit">Enviar</button>

    </form>

@endsection
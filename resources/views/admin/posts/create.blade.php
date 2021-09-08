@extends('admin.layouts.app')

@section('title', 'Novo')    

@section('content')

    <h1>Novo Post</h1>

    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">

        @include('admin.posts.form')

    </form>

@endsection
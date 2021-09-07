@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@csrf

<input class="form-control" type="text" name="title" id="title" placeholder="Título" value="{{ $post->title ?? old('title') }}">

<div class="form-group">
    <label for="my-textarea">Text</label>
    <textarea id="content" class="form-control" name="content" cols="30" rows="4" placeholder="Conteúdo">{{ $post->content ?? old('content') }}</textarea>
</div>
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@csrf

<div class="form-group">
    <label for="titulo" class="form-label">Título</label>
    <input class="form-control" type="text" name="title" id="title" placeholder="Título" required value="{{ $post->title ?? old('title') }}">
</div>

<div class="form-group">
    <label for="conteudo"  class="form-label">Conteúdo</label>
    <textarea id="content" class="form-control" name="content" cols="30" rows="4" required placeholder="Conteúdo">{{ $post->content ?? old('content') }}</textarea>    
</div>

<hr>

<div class="form-group">
    @if (isset($post))
        <img src="{{ url("storage/{$post->image}") }}" style="width: 100px;">    
    @endif
</div>

<div class="form-group">
    <input type="file" name="image" id="image">
</div>

<hr>

<button type="submit" class="btn btn-success">Enviar</button>
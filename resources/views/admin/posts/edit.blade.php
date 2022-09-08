@extends('layouts.dashboard')

@section('content')
<form action="{{ route('admin.posts.update', ['post'=>$post->id]) }}" method="post">
    @csrf
    @method('PUT')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Titolo --}}
    <div class="mb-3">
        <label for="title" class="form-label">Titolo</label>
        <input type="text" class="form-control" placeholder="Max: 100 char" id="title" name="title" value="{{ $post->title }}">
    </div>


    {{-- Categoria --}}
    <div class="mb-3">
        <label for="category">Categoria: </label>
        <select class="form-select" id="category" name="category_id">
            <option value="">Nessuna</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}" {{ old('category_id', isset($post->category->id) ? $post->category->id : '') == $category->id ? 'selected' : ''}}> {{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Tags --}}
    <span>Tags:</span>
    <br>
    @foreach ($tags as $tag)
        <input 
            class="form-check-input" 
            type="checkbox" 
            value="{{ $tag->id }}" 
            id="tag-{{$tag->id}}" 
            name="tags[]" 
            {{ $post->tags->contains($tag) ? 'checked' : '' }}
        >
        <label class="form-check-label" for="tag-{{$tag->id}}" > {{$tag->name}} </label>
    @endforeach

    {{-- Contenuto --}}
    <div class="mb-3">
        <label for="content" class="form-label">Contenuto post:</label>
        <textarea type="text" class="form-control" id="content" name="content" cols="30" rows="10" >{{$post->content}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Modifica Post</button>
</form>
    
@endsection

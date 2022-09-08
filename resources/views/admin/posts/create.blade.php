@extends('layouts.dashboard')

@section('content')
    <form action="{{ route('admin.posts.store') }}" method="post">
        @csrf
        @method('POST')

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
            <input type="text" class="form-control" placeholder="Max: 100 char" id="title" name="title" value="{{old('title')}}">
        </div>

        {{-- Categoria --}}
        <div class="mb-3">
            <label for="category">Categoria: </label>
            <select class="form-select" id="category" name="category_id">
                <option value="">Nessuna</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : ''}}> {{ $category->name }}</option>
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
            {{ in_array($tag->id, old('tags',[])) ? 'checked' : '' }}
            >
            <label class="form-check-label" for="tag-{{$tag->id}}" > {{$tag->name}} </label>
            
        @endforeach



        {{-- Contenuto post --}}
        <div class="mb-3">
            <label for="content" class="form-label">Contenuto post:</label>
            <textarea type="text" class="form-control" id="content" name="content" cols="30" rows="10" >{{old('content')}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Crea Post</button>
    </form>
@endsection

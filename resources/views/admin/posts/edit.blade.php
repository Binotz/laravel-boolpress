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

    <div class="mb-3">
        <label for="title" class="form-label">Titolo</label>
        <input type="text" class="form-control" placeholder="Max: 100 char" id="title" name="title" value="{{ $post->title }}">
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Contenuto post:</label>
        <textarea type="text" class="form-control" id="content" name="content" cols="30" rows="10" >{{$post->content}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Modifica Post</button>
</form>
    
@endsection
@extends('layouts.dashboard')

@section('content')  
   <div class="post-layout">
        <span>Titolo:</span>
        <h1>{{$post->title}}</h1>
        <span>Slug:</span>
        <p>{{$post->slug}}</p>
        <span>contenuto:</span>
        <p>{{$post->content}}</p>
        <span>Data scrittura:</span>
        <h6>{{$post->created_at}}</h6>
        <span>Data ultima modifica:</span>
        <h6>{{$post->updated_at}}</h6>
   </div>
@endsection

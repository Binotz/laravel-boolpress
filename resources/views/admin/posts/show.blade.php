@extends('layouts.dashboard')

@section('content')  
   <div class="post-layout">
      <div class="details">        
         <span>Titolo:</span>
         <h1>{{$post->title}}</h1>
         <span>Slug:</span>
         <p>{{$post->slug}}</p>
         <span>contenuto:</span>
         <p>{{$post->content}}</p>
         <span>Data scrittura:</span>
         <h6>{{$post->created_at->toFormattedDateString()}}</h6>
         <span>Data ultima modifica:</span>
         <h6>{{$post->updated_at->toFormattedDateString()}}</h6>

         <span>Categoria: </span>
         <h6>{{ ($post->category) ? $post->category->name : 'Nessuna'}}</h6>
      </div>

      <div class="actions">
         <a class="btn btn-primary" href="{{route('admin.posts.edit', ['post' => $post->id])}}">Modifica </a>
         <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onClick="return confirm('Sei sicuro di ciò che vuoi fare? e se poi te ne penti?');">Elimina Post</button>
         </form>
      </div>
   </div>
@endsection

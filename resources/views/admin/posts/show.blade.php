@extends('layouts.dashboard')

@section('content')  
   <div class="post-layout">
      <div class="details">   
         
         <div>
            <span>Titolo:</span>
            <h1>{{$post->title}}</h1>
         </div>
         <div>
            <img src="{{ asset('storage/' . $post['cover']) }}" alt="cover" class="w-50">
         </div>
         <div>
            <span>Slug:</span>
            <p>{{$post->slug}}</p>
         </div>
         <div>         
            <span>contenuto:</span>
            <p>{{$post->content}}</p>
         </div>
         <div>
            <span>Data scrittura:</span>
            <h6>{{$post->created_at->toFormattedDateString()}}</h6>
         </div>
         <div>
            <span>Data ultima modifica:</span>
            <h6>{{$post->updated_at->toFormattedDateString()}}</h6>
         </div>
         <div>
            <span>Categoria: </span>
            <h6>{{ ($post->category) ? $post->category->name : 'Nessuna'}}</h6>
         </div>
         <div>
            <span>Tags: </span>
            <h6> 
               @forelse ($post->tags as $tag)
               {{$tag->name}}{{ (!$loop->last) ? ', ' : ''}}
               @empty
                  Nessuna
               @endforelse 
            </h6>
         </div>
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

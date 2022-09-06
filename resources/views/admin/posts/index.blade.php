@extends('layouts.dashboard')

@section('content')
    <h1>Lista dei posts</h1>
    <div class="row row-cols-3 gy-4">
        @foreach ($posts as $post)
            <div class="col">
                <div class="card" >
                    <div class="card-body">
                      <h5 class="card-title">{{ $post->title }}</h5>
                      <a href="{{ route('admin.posts.show',['post' => $post->id]) }}" class="card-link">Dettagli Post</a>
                    </div>
                  </div>
            </div>
        @endforeach
    </div>
@endsection

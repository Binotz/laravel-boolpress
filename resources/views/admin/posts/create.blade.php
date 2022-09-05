@extends('layouts.dashboard')

@section('content')
    <form>
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Contenuto post:</label>
            <textarea type="text" class="form-control" id="content" name="content" cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Crea Post</button>
    </form>
@endsection

@extends('layout', [
  'title' => 'List of Genres'
])

@section('headline')
  <h1>List of Genres</h1>
@endsection

@section('content')

  <div style="padding-top: 1rem;">
  @foreach ($genres as $genre)
    <div style="display:flex; flex-direction: column; padding-top: 1em;">
      <h3>{{$genre->name}}</h3>
      <a href="{{ action('GenreController@show', [$genre->id]) }}">Books in the category</a>
    </div>
  <hr/>
  @endforeach
  
  <a href="{{ action('GenreController@create') }}">Create new genre</a>

  

  </div>

@endsection
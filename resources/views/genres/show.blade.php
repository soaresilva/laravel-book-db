@extends('layout', [
  'title' => 'Book info'
])

@section('headline')
  <h2>List of books with the genre {{$genre->name}}</h2><hr/>
@endsection

@section('content')

<div>
      @foreach ($books as $book)
        <div class="imgdisplay">
          <img src="{{$book->image}}" /><br>
          <div class="bookdisplay">
            <a href="{{ action('BookController@show', [$book->id]) }}">{{$book->title}}</a>
            <p><em>{{$book->authors}}</em> ({{$book->publisher !== null ? $book->publisher->title : "Publisher unknown"}})</p>
          </div>
        </div>
        <hr/>
      @endforeach
    <a href="{{ action('GenreController@index') }}">Go back to index of genres</a>
    </div>
</div>

@endsection
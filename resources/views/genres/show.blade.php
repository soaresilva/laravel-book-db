@extends('layout', [
  'title' => 'Book info'
])

@section('headline')
  <h2>List of books with the genre {{$genre->name}}</h2>
@endsection

@section('content')

<div style="padding-top: 1em;">
      @foreach ($books as $book)
        <div class="imgdisplay">
          <img src="{{$book->image}}" /><br>
          <div class="bookdisplay">
            <h2>{{$book->title}}</h2>
            <i><b>{{$book->authors}}</b> ({{$book->publisher->title}})</i><br>
          </div>
        </div>
        <hr/>
      @endforeach
    <a href="{{ action('GenreController@index') }}">Go back to index of genres</a>
    </div>
</div>

@endsection


{{-- because we set the relationship in App\Book and App\Publisher, we can now get the publisher's name: $book->publisher->title gets the publisher's ID, and then inside the table publisher it fetches the publisher's name (title) --}}
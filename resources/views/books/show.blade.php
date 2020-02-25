<link rel="stylesheet" href="<?php echo asset('css/app.css')?>" type="text/css"> 

<div style="display:flex; padding: 1em;">
  <img src="{{$book->image}}" /><br>
  <div style="display:flex; flex-direction: column; padding-left: 3em;">
    <h2>{{$book->title}}</h2>
    <i><b>{{$book->authors}}</b> ({{$book->publisher->title}})</i><br>
    <p>{{$book->genre !== null ? $book->genre->name : ""}}</p>
    <a href="/books/{{$book->id}}/edit">Edit book</a>
    <a href="/books/{{$book->id}}/delete">Delete book</a>
    <a href="{{ action('BookExampleController@index') }}">Go back to index</a>
  </div>
</div>

{{-- because we set the relationship in App\Book and App\Publisher, we can now get the publisher's name: $book->publisher->title gets the publisher's ID, and then inside the table publisher it fetches the publisher's name (title) --}}
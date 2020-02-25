<link rel="stylesheet" href="<?php echo asset('css/app.css')?>" type="text/css"> 

<div style="padding: 1em;">
  <h2>List of books with the genre {{$genre->name}}</h2>
      @foreach ($books as $book)
        <div style="display:flex; padding: 1em;">
          <img src="{{$book->image}}" /><br>
          <div style="display:flex; flex-direction: column; padding-left: 3em;">
            <h2>{{$book->title}}</h2>
            <i><b>{{$book->authors}}</b> ({{$book->publisher->title}})</i><br>
          </div>
        </div>
        <hr/>
      @endforeach
    <a href="{{ action('GenreController@index') }}">Go back to index of genres</a>
    </div>
</div>

{{-- because we set the relationship in App\Book and App\Publisher, we can now get the publisher's name: $book->publisher->title gets the publisher's ID, and then inside the table publisher it fetches the publisher's name (title) --}}
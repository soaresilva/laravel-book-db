<div style="padding: 1em;">
  <h2>List of books published by {{$publisher->title}}</h2>
      @foreach ($books as $book)
        <div style="display:flex; padding: 1em;">
          <img src="{{$book->image}}" /><br>
          <div style="display:flex; flex-direction: column; padding-left: 3em;">
            <h2>{{$book->title}}</h2>
            <h4><i>{{$book->authors}}</i></h4>
          </div>
        </div>
        <hr/>
      @endforeach
  <a href="{{ action('PublisherController@index') }}">Go back to list of publishers</a>
  </div>
</div>
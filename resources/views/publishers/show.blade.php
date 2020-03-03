@extends('layout', [
  'title' => 'List of Books'
])

@section('headline')
  <h2>List of books published by {{$publisher->title}}</h2>
@endsection

@section('content')
<div style="padding: 1em;">
      @foreach ($books as $book)
        <div class="imgdisplay">
          <img src="{{$book->image}}" /><br>
            <div class="bookdisplay">
              <h2>{{$book->title}}</h2>
              <h4><i>{{$book->authors}}</i></h4>
            </div>
        </div>
        <hr/>
      @endforeach
  <a href="{{ action('PublisherController@index') }}">Go back to list of publishers</a>
  </div>
</div>

@endsection
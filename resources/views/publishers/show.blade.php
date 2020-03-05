@extends('layout', [
  'title' => 'List of Publishers'
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
              <a href="{{ action('BookExampleController@show', [$book->id]) }}">{{$book->title}}</a>
              <i>{{$book->authors}}</i>
            </div>
        </div>
        <hr/>
      @endforeach
  <a href="{{ action('PublisherController@index') }}">Go back to list of publishers</a>
  </div>
</div>

@endsection



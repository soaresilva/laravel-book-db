@extends('layout', [
  'title' => 'List of Books'
])

@if(Session::has('success_message'))
    <div class="alert alert-success">
        {{ Session::get('success_message') }}
    </div>
@endif

@section('headline')
  <h1>List of Books</h1>
@endsection

@section('content')

{{ $books->links() }}

@foreach ($books as $book)
<div style="display:flex; padding-top: 1em;">
  <img src="{{$book->image}}" /><br>
  <div style="display:flex; flex-direction: column; padding-left: 2em;">
    <h2>{{$book->title}}</h2>
  <h4><i>{{$book->authors}}</i> ({{$book->publisher->title}})</h4>
    <a href="{{ action('BookExampleController@show', [$book->id]) }}">Read more</a>
    <a href="/cart/add/{{ $book->id }}">Add to Cart</a>

  </div>
</div>
<hr/>
@endforeach

{{ $books->links() }}

@endsection
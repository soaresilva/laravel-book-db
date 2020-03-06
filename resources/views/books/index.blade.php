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

@can('admin')  
<h3><a href="{{ action('BookController@create') }}">Add book to database</a></h3><hr/>
@endcan

@foreach ($books as $book)
<div style="display:flex">
  <img src="{{$book->image}}" /><br>
  <div style="display:flex; flex-direction: column; padding-left: 2em;">
    <h2>{{$book->title}}</h2>
  <h4><i>{{$book->authors}}</i> ({{$book->publisher->title}})</h4>
    <a href="{{ action('BookController@show', [$book->id]) }}">Read more</a>
    <a href="/cart/add/{{ $book->id }}">Add to Cart</a>

  </div>
</div>
<hr/>
@endforeach

{{ $books->links() }}

@endsection
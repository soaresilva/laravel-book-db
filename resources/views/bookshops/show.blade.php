@extends('layout', [
  'title' => 'List of Books'
])

@section('headline')
  <h2>List of books for sale at {{$bookshop->name}}, {{$bookshop->city}}</h2>
@endsection

@section('content')
  <form action="{{ action('BookshopController@addBook', [$bookshop->id]) }}" method="post">
  @csrf
  <select name="book_id" style="width: 200px">
    @foreach ($books as $book)
      <option value="{{$book->id}}">{{$book->title}}</option>
    @endforeach
  </select>
  <input type="submit" value="Add to bookstore">
  
</form>

<div style="padding: 1em;">
  {{-- @forelse ($books as $book)
  <div style="display:flex; flex-direction: column; padding-left: 3em;">
    <p><a href="{{ action('BookExampleController@show', [$bookshop->book->id]) }}">
    {{$bookshop->book->title}}
    </a>
    ({{$bookshop->book->publisher !== null ? $bookshop->book->publisher->title : "Publisher unknown"}})</p>
  </div>
<hr/>
@empty
<p>There are no books for sale in this bookshop.</p>
@endforelse --}}

  <a href="{{ action('BookshopController@index') }}">Go back to list of bookshops</a>
  </div>
</div>

@endsection



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
  <input type="number" name="count" value="1" style="width:30px">
  <input type="submit" value="Add to bookshop">
  
</form>

<div style="padding: 1em;">
  @forelse ($bookshop->books as $book)
    <div style="display:flex; flex-direction: column; padding-left: 3em;">
      <p><a href="{{ action('BookExampleController@show', [$book->id]) }}">
      {{$book->title}}
      </a>
    ({{$book->publisher !== null ? $book->publisher->title : "Publisher unknown"}}) ({{$book->pivot->count}} units)</p>
      
      <form action="{{ action('BookshopController@removeBook', [$bookshop->id]) }}" method="post">
        @csrf
        <input type="hidden" name="book" value="{{$book->id}}">
        <input type="submit" value="Remove book">
      </form>   
  
    </div>
    <hr/>
  @empty
    <p>There are no books for sale in this bookshop.</p>
  @endforelse

  <a href="{{ action('BookshopController@index') }}">Go back to list of bookshops</a>
  </div>
</div>

@endsection



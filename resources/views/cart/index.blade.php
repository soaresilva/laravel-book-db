@extends('layout', [
  'title' => 'Your cart'
])

@section('headline')
<h2>Items in the cart</h2>
@endsection

@section('content')

<div style="padding: 1rem;">

  <div>
      <a href="{{ action('BookExampleController@index') }}">Return to list of books</a> |
      <a href="{{ action('CartController@emptycart') }}">Empty cart</a>
  </div>
  
  <div style="padding-top: 1rem">
  
      @foreach ($items as $item)
          <div style="display:flex; flex-direction: column; padding-left: 3em;">
            <p><a href="{{ action('BookExampleController@show', [$item->book->id]) }}">
            {{$item->book->title}}
            </a>
            ({{$item->book->publisher->title}})</p>
            <p>In cart: <b>{{$item->count}}</b> | <a href="/cart/{{$item->id}}/delete">Remove from cart</a></p>
          </div>
        <hr/>
      @endforeach

  </div>
</div>

@endsection

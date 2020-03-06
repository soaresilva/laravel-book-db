{{-- TODO: make the cart exclusive of a certain user; that is not implemented yet. User --}}

@extends('layout', [
  'title' => 'Your cart'
])

@section('headline')
<h2>Items in the cart</h2>
@endsection

@section('content')

<div style="padding: 1rem;">

  <div>
      <a href="{{ action('BookController@index') }}">Return to list of books</a> |
      <a href="{{ action('CartController@emptycart') }}">Empty cart</a>
  </div>
  
  <div style="padding-top: 1rem">
  
      @forelse ($items as $item)
          <div style="display:flex; flex-direction: column; padding-left: 3em;">
            <p><a href="{{ action('BookController@show', [$item->book->id]) }}">
            {{$item->book->title}}
            </a>
            ({{$item->book->publisher !== null ? $item->book->publisher->title : "Publisher unknown"}})</p>
            <p>In cart: <b>{{$item->count}}</b></p>
            
            <form action="{{ route('cart.delete', $item->id) }}" method="post">
              @method('delete')
              @csrf
              <input type="submit" value="Remove from cart">
            </form>   
        
          </div>
        <hr/>
      @empty
        <p>Your cart is empty.</p>
      @endforelse

  </div>
</div>

@endsection

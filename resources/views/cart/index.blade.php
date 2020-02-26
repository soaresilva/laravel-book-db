{{-- THIS IS THE CART INDEX --}}

<link rel="stylesheet" href="<?php echo asset('css/app.css')?>" type="text/css"> 

<div style="padding: 1rem;">

<h2>Items in the cart</h2>

<a href="{{ action('BookExampleController@index') }}">Return to list of books</a>
<a href="{{ action('CartController@emptycart') }}">Empty cart</a>


@foreach ($items as $item)
    <div style="display:flex; flex-direction: column; padding-left: 3em;">
      <p><a href="{{ action('BookExampleController@show', [$item->book->id]) }}">
      {{$item->book->title}}
      </a>
      ({{$item->book->publisher->title}})</p>
      <p>In cart: <b>{{$item->count}}</b></p>
    </div>
  <hr/>
@endforeach

</div>
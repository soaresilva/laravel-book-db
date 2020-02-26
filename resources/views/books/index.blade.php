<link rel="stylesheet" href="<?php echo asset('css/app.css')?>" type="text/css"> 

<div style="padding: 1em;">
<h1>List of Books</h1>
<a href="{{ action('CartController@index') }}">View cart</a>
</div>

@foreach ($books as $book)
<div style="display:flex; padding: 1em;">
  <img src="{{$book->image}}" /><br>
  <div style="display:flex; flex-direction: column; padding-left: 3em;">
    <h2>{{$book->title}}</h2>
  <h4><i>{{$book->authors}}</i></h4>
    <a href="{{ action('BookExampleController@show', [$book->id]) }}">Read more</a>
    <a href="/cart/add/{{ $book->id }}">Add to Cart</a>
    
  {{-- <form action="/cart/add" method="post">
      @csrf
      <input type="text" name="book_id" value="">
      <input type="submit" value="Add to cart"/>
  </form> --}}


  </div>
</div>
<hr/>
@endforeach
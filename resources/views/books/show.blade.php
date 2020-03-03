@extends('layout', [
  'title' => 'Book info'
])

@if(Session::has('success_message'))
    <div class="alert alert-success">
        {{ Session::get('success_message') }}
    </div>
@endif

@section('headline')
  <h2>Book details</h2>
@endsection

@section('content')

<div class="imgdisplay">
  <img src="{{$book->image}}" /><br>
  <div class="bookdisplay">
    <h2>{{$book->title}}</h2>
    <i><b>{{$book->authors}}</b> ({{$book->publisher !== null ? $book->publisher->title : "Publisher unknown"}})</i>
    <p><b>Genre</b>: {{$book->genre !== null ? $book->genre->name : ""}}</p>
    <a href="/books/{{$book->id}}/edit">Edit book</a>
    <a href="/books/{{$book->id}}/delete">Delete book</a>
    <a href="/cart/add/{{ $book->id }}">Add to Cart</a>
    <a href="{{ action('BookExampleController@index') }}">Go back to index</a>    
  </div>
</div>

@endsection

@section('listreviews')

  <div style="display:flex; flex-direction: column; padding-top: 1em;">

    <h3>Reviews for {{$book->title}} </h3>

    @forelse ($book->reviews as $review)
      <p><b><a href="mailto:{{$review->email}}">{{$review->author}}</a></b>: {{$review->review}}</p>
    @empty
      <p>This book has no reviews. Write one?</p>
    @endforelse

  </div>

@endsection

@section('review')

<div style="display:flex">

  <form action="{{ action('ReviewController@store', $book->id)}}" method="post" style="display: flex; flex-direction: column; margin-top: 2rem;">
    @csrf
    <h3>Write a review</h3>

    @if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    <input type='text' placeholder='Your name' value="{{old('author')}}" name='author' style="margin-bottom: .5rem; width: 20rem;" />
    
    <input type='text' placeholder='Your email' value="{{old('email')}}" name='email' style="margin-bottom: .5rem; width: 20rem;" />

    <textarea rows="5" columns="10" placeholder='Write your review' name='review' style="margin-bottom: .5rem;">{{old('review')}}</textarea>
    <input type='Submit'style="margin-bottom: .5rem;" />
  </form>
  
</div>

@endsection


{{-- because we set the relationship in App\Book and App\Publisher, we can now get the publisher's name: $book->publisher->title gets the publisher's ID, and then inside the table publisher it fetches the publisher's name (title) --}}

{{-- maxlength="255"  --}}
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
    
    @can('admin')
    <form action="{{ route('book.delete', $book->id) }}" method="post">
      @method('delete')
      @csrf
      <input type="submit" value="Delete book">
    </form>   
    
    <a href="/books/{{$book->id}}/edit">Edit book</a>

    @endcan
    
    <a href="/cart/add/{{ $book->id }}">Add to Cart</a>
  </div>
</div>
<hr/>

@endsection

@section('listbookshops')

<div style="padding: 1em;">

  <h3>Bookshops where you can find {{$book->title}} </h3>
  
    @forelse ($book->bookshops as $bookshop)
      <div style="display:flex; flex-direction: column;">
        <p><a href="{{ action('BookshopController@show', [$bookshop->id]) }}">
        {{$bookshop->name}}
        </a>
      </div>
  </div>

      @can('admin')  
        <form action="{{ action('BookExampleController@removeBookshop', [$book->id]) }}" method="post">
          @csrf
          <input type="hidden" name="bookshop" value="{{$bookshop->id}}">
          <input type="submit" value="Remove from bookshop">
        </form>   
      @endcan

    <hr/>

    @empty
    <p>"{{$book->title}}" is sold out in every bookshop.</p>
    @endforelse

    @can('admin')  
      <div style="display: flex; direction:flex-column;">
          <form action="{{ action('BookExampleController@addBookshop', [$book->id]) }}" method="post">
            @csrf
            <select name="bookshop_id" style="width: 150px">
              @foreach ($bookshops as $bookshop)
                <option value="{{$bookshop->id}}">{{$bookshop->name}}</option>
              @endforeach
            </select>
            <input type="submit" value="Add to bookshop">
          </form>
      </div>
      <hr/>
    @endcan
    
@endsection

@section('relatedbooks')

@can('admin')
<div style="display: flex; direction:flex-column;">
    <form action="{{ action('BookExampleController@addRelated', [$book->id]) }}" method="post">
      @csrf
      <select name="book2" style="width: 150px">
        @foreach ($books as $book2)
          <option value="{{$book2->id}}">{{$book2->title}}</option>
        @endforeach
      </select>
      <input type="submit" value="Add to related books">
    </form>
</div>
@endcan
<hr/>

<h3>You might also be interested in...</h3>
  
@forelse ($book->books as $relatedbook)
  <div style="display:flex; flex-direction: column;">
    <p><a href="{{ action('BookExampleController@show', [$book->id]) }}">
    {{$relatedbook->title}}
    </a>
  </div>
</div>

  @can('admin')  
    <form action="{{ action('BookExampleController@removeRelated', [$book->id]) }}" method="post">
      @csrf
      <input type="hidden" name="book2" value="{{$relatedbook->id}}">
      <input type="submit" value="Remove related book">
    </form>   
  @endcan
<hr/>

@empty
<p>No suggestions.</p>
@endforelse


@endsection

@section('listreviews')

  <div style="display:flex; flex-direction: column; padding-top: 1em;">

    <h3>Reviews for {{$book->title}} </h3>

    @forelse ($book->reviews as $review)
      <p><b><a href="mailto:{{$review->user->email}}">{{$review->user->name}}</a></b>: {{$review->review}}</p>
      
    @can('admin')
      <form action="{{ action('ReviewController@delete', $review->id) }}" method="post">
          @method('delete')
          @csrf
          <input type="submit" style="width: 70px" value="delete">
      </form>
    @endcan
      
    @empty
      <p>This book has no reviews. Write one?</p>
    @endforelse

@guest
  <h3>Please <a href=" {{ route('login') }}">login</a> to leave a review.</h3>
@endguest
  </div>

@endsection


@auth

@section('review')

<div style="display:flex; flex-direction: column">

  <form action="{{ action('ReviewController@store', [$book->id])}}" method="post" style="display: flex; flex-direction: column; margin-top: 2rem;">
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

    <input type='text' disabled value="{{ Auth::user()->name }}" name='author' style="margin-bottom: .5rem; width: 20rem;" />
    
    <input type='text' disabled value="{{ Auth::user()->email }}" name='email' style="margin-bottom: .5rem; width: 20rem;" />

    <textarea rows="5" placeholder='Write your review' name='review' style="margin-bottom: .5rem; width: 20rem;">{{old('review')}}</textarea>
    <input type='Submit'style="margin-bottom: .5rem; width: 60px" />
  </form>
  
</div>

@endsection

@endauth
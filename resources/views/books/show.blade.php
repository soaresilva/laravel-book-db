@extends('layout', [
  'title' => 'Book info'
])


@section('headline')

@if(Session::has('success_message'))
    <div class="alert alert-success">
        {{ Session::get('success_message') }}
    </div>
@endif

  <h2>Book details</h2><hr/>
@endsection

@section('content')

<div class="imgdisplay">
  <img src="{{$book->image}}" /><br>
  <div class="bookdisplay">
    <h2>{{$book->title}}</h2>
    <p><em><b>{{$book->authors}}</b></em> ({{$book->publisher !== null ? $book->publisher->title : "Publisher unknown"}})</p>
    <p><b>Genre</b>: {{$book->genre !== null ? $book->genre->name : ""}}</p>
    
    @can('admin')
    <form action="{{ route('book.delete', $book->id) }}" method="post">
      @method('delete')
      @csrf
      <input type="submit" value="Delete book from database">
    </form>
    <br>
    <form action="{{ route('book.edit', $book->id) }}" method="get">
      <input type="submit" value="Edit book">
    </form>
    <br>
    @endcan
    
    <a href="/cart/add/{{ $book->id }}">Add to Cart</a>
  </div>
</div>
<hr/>

@endsection

@section('listbookshops')

<div style="">

  <h3>Bookshops where you can find {{$book->title}} </h3>
  
    @forelse ($book->bookshops as $bookshop)
      <div style="display:flex; flex-direction: column;">
        <p><a href="{{ action('BookshopController@show', [$bookshop->id]) }}">
        {{$bookshop->name}} ({{ $bookshop->city }})
        </a>
      </div>
  </div>

      @can('admin')  
        <form action="{{ action('BookController@removeBookshop', [$book->id]) }}" method="post">
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
          <form action="{{ action('BookController@addBookshop', [$book->id]) }}" method="post">
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
    <form action="{{ action('BookController@addRelated', [$book->id]) }}" method="post">
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
    <p><a href="{{ action('BookController@show', [$book->id]) }}">
    {{$relatedbook->title}}</a></p>
  </div>

  @can('admin')  
    <form action="{{ action('BookController@removeRelated', [$book->id]) }}" method="post">
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
<div>

      <h3>Reviews for {{$book->title}} </h3>
      @forelse ($book->reviews as $review)
      <div style="display:flex; justify-content: space-between; width: 45%">
        <p><b><a href="mailto:{{$review->user->email}}">{{$review->user->name}}</a></b>: {{$review->review}}</p>
      @can('admin')
        <form action="{{ action('ReviewController@delete', $review->id) }}" method="post">
            @method('delete')
            @csrf
            <input type="submit" style="width: 70px" value="delete">
        </form>
      @endcan
    </div>
    @empty
      <p>This book has no reviews. Write one?</p>
    @endforelse
    <hr />

@guest
  <h3>Please <a href=" {{ route('login') }}">login</a> to leave a review.</h3>
@endguest
  </div>

@endsection


@auth

@section('review')
  <form action="{{ action('ReviewController@store', [$book->id])}}" method="post" style="display: flex; flex-direction: column;">
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
  
@endsection

@endauth
@extends('layout', [
  'title' => 'Edit a Book'
])

@section('content')
<form action="{{ action('BookController@update', [$book->id]) }}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">
  <input type="text" name="title" placeholder="Title" value="{{$book->title}}" style="width:25%">
</div>
<div class="form-group">
  <input type="text" name="authors" placeholder="Authors" value="{{$book->authors}}" style="width:25%">
</div>
<div class="form-group">
  <select name="genre_id">
    @foreach ($genres as $genre)
      <option value="{{$genre->id}}" {{$genre->id == $book->genre_id ? "selected" : ""}}>{{$genre->name}}</option> 
    @endforeach
  </select>
</div>
<div class="form-group">
  <input type="file" name="image_file">
</div>
<div class="form-group">
  <select name="publisher_id">
    @foreach ($publishers as $publisher)
  <option value="{{$publisher->id}}" {{$publisher->id == $book->publisher_id ? "selected" : ""}}>{{$publisher->title}}</option>
    @endforeach
  </select>
</div>
<div class="form-group">
  <input type="submit">
</div>
</form>
@endsection
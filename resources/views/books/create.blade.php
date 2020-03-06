@extends('layout', [
  'title' => 'Create a Book'
])

@section('content')
<form action="/books" method="post" enctype="multipart/form-data" style="padding: 1rem;">
  @csrf
  <div class="form-group">
    <input type="text" name="title" placeholder="Title" style="width:25%">
  </div>
  <div class="form-group">
    <input type="text" name="authors" placeholder="Authors" style="width:25%">
  </div>
  <div class="form-group">
    <select name="genre_id">
      @foreach ($genres as $genre)
        <option value="{{$genre->id}}">{{$genre->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <input type="file" name="image_file">
  </div>
  <div class="form-group">
    <select name="publisher_id">
      @foreach ($publishers as $publisher)
        <option value="{{$publisher->id}}">{{$publisher->title}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <input type="submit">
  </div>
</form>
@endsection
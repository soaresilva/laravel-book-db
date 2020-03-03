@extends('layout', [
  'title' => 'Create a Book'
])

@section('content')
<div style="display:flex">
  <div style="flex-direction: column">
  <form action="/books" method="post" enctype="multipart/form-data">
  @csrf
    <input type="text" name="title" placeholder="Title">
    <input type="text" name="authors" placeholder="Authors">
    <select name="genre_id">
      @foreach ($genres as $genre)
        <option value="{{$genre->id}}">{{$genre->name}}</option>
      @endforeach
    </select>
    
    <input type="file" name="image_file">

    <select name="publisher_id">
      @foreach ($publishers as $publisher)
        <option value="{{$publisher->id}}">{{$publisher->title}}</option>
      @endforeach
    </select>
    <input type="submit">
  </form>
  </div>
</div>

@endsection


{{-- there needs to be a @csrf tag, or it won't produce a token and will return a 419 error --}}
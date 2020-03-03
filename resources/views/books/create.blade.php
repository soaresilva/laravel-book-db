@extends('layout', [
  'title' => 'Create a Book'
])

<form action="/books" method="post">
@csrf
  <input type="text" name="title" placeholder="Title">
  <input type="text" name="authors" placeholder="Authors">
  <select name="genre_id">
    @foreach ($genres as $genre)
      <option value="{{$genre->id}}">{{$genre->name}}</option>
    @endforeach
  </select>
  <input type="text" name="image" placeholder="Image URL">
  <select name="publisher_id">
    @foreach ($publishers as $publisher)
      <option value="{{$publisher->id}}">{{$publisher->title}}</option>
    @endforeach
  </select>
  <input type="submit">
</form>

{{-- there needs to be a @csrf tag, or it won't produce a token and will return a 419 error --}}
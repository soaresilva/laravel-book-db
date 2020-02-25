<form action="/books/{{$book->id}}/edit" method="post">
@csrf
  <input type="text" name="title" placeholder="Title" value="{{$book->title}}">
  <input type="text" name="authors" placeholder="Authors" value="{{$book->authors}}">
  <select name="genre_id">
    @foreach ($genres as $genre)
      <option value="{{$genre->id}}" {{$genre->id == $book->genre_id ? "selected" : ""}}>{{$genre->name}}</option> 
    @endforeach
  </select>
  <input type="text" name="image" placeholder="Image URL" value="{{$book->image}}">
  <select name="publisher_id">
    @foreach ($publishers as $publisher)
  <option value="{{$publisher->id}}" {{$publisher->id == $book->publisher_id ? "selected" : ""}}>{{$publisher->title}}</option>
    @endforeach
  </select>
  <input type="submit">
</form>

{{-- there needs to be a @csrf tag, or it won't produce a token and will return a 419 error --}}

{{-- notice the "/books/{{$book->id}}/edit" on top. we need to get the proper id instead of using just {id} --}}
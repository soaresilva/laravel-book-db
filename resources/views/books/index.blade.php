<style>
  a {
    text-decoration: none;
  }
  a:visited {
    color: blue;
  }
</style>

@foreach ($books as $book)
<div style="display:flex; padding: 1em;">
  <img src="{{$book->image}}" /><br>
  <div style="display:flex; flex-direction: column; padding-left: 3em;">
    <h2>{{$book->title}}</h2>
  <h4><i>{{$book->authors}}</i></h4>
    <a href="{{ action('BookExampleController@show', [$book->id]) }}">Read more</a>
  </div>
</div>
<hr/>
@endforeach
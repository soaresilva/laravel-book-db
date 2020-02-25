<link rel="stylesheet" href="<?php echo asset('css/app.css')?>" type="text/css"> 

<div style="padding: 1rem;">

<h2>List of genres</h2>

@foreach ($genres as $genre)
  <div style="display:flex; flex-direction: column; padding-left: 3em;">
    <h3>{{$genre->name}}</h3>
    <a href="{{ action('GenreController@show', [$genre->id]) }}">Books in the category</a>
  </div>
<hr/>
@endforeach

</div>
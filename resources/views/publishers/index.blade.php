<link rel="stylesheet" href="<?php echo asset('css/app.css')?>" type="text/css"> 

@foreach ($publishers as $publisher)
<div style="padding: 1em;">
    <h2>{{$publisher->title}}</h2>
    <a href="{{ action('PublisherController@show', [$publisher->id]) }}">Read more</a>
</div>
<hr/>
@endforeach
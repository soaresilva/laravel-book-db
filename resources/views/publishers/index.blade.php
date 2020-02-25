@foreach ($publishers as $publisher)
<div style="padding: 1em;">
    <h2>{{$publisher->title}}</h2>
    <a href="{{ action('PublisherController@show', [$publisher->id]) }}">Read more</a>
</div>
<hr/>
@endforeach
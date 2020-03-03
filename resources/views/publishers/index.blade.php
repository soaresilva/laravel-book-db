@extends('layout', [
  'title' => 'List of Publishers'
])

@section('headline')
  <h1>List of Publishers</h1>
@endsection


@section('content')
    @foreach ($publishers as $publisher)
    <div style="padding-top: 1em;">
        <h3>{{$publisher->title}}</h3>
        <a href="{{ action('PublisherController@show', [$publisher->id]) }}">Read more</a>
    </div>
    <hr/>
    @endforeach
    
    <a href="{{ action('PublisherController@create') }}">Create new publisher</a>

@endsection
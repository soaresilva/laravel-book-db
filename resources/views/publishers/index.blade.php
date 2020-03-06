@extends('layout', [
  'title' => 'List of Publishers'
])

@section('headline')
  <h1>List of Publishers</h1>
@endsection


@section('content')

@can('admin')  
<h3><a href="{{ action('PublisherController@create') }}">Add publisher to database</a></h3><hr/>
@endcan

    @foreach ($publishers as $publisher)
    <div>
        <h3>{{$publisher->title}}</h3>
        <a href="{{ action('PublisherController@show', [$publisher->id]) }}">See editions</a>
    </div>
    <hr/>
    @endforeach
    
    <a href="{{ action('PublisherController@create') }}">Create new publisher</a>

@endsection
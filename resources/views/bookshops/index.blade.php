@extends('layout', [
  'title' => 'List of Bookshops'
])

@if(Session::has('success_message'))
    <div class="alert alert-success">
        {{ Session::get('success_message') }}
    </div>
@endif

@section('headline')
  <h1>List of Bookshops</h1>
@endsection

@section('content')

@can('admin')  
<h3><a href="{{ action('BookshopController@create') }}">Add bookshop to database</a></h3><hr/>
@endcan

    @foreach ($bookshops as $bookshop)
    <div>
        <h3>{{$bookshop->name}} ({{$bookshop->city}})</h3>
        <a href="{{ action('BookshopController@show', [$bookshop->id]) }}">More info</a>
    </div>
    <hr/>
    @endforeach
    
    <a href="{{ action('BookshopController@create') }}">Create new bookshop</a>

@endsection
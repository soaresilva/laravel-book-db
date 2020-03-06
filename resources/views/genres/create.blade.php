@extends('layout', [
  'title' => 'Create new genre'
])

@section('headline')
  <h2>Create new genre</h2>
@endsection

@section('content')
<form action="/genres" method="post">
@csrf
  <input type="text" name="name" placeholder="New genre">
  <input type="submit" value="Add to database">
</form>
@endsection
@extends('layout', [
  'title' => 'Create new publisher'
])

@section('headline')
  <h2>Create new publisher</h2>
@endsection

@section('content')
<form action="/publishers" method="post">
@csrf
  <input type="text" name="name" placeholder="New publisher">
  <input type="submit">
</form>
@endsection
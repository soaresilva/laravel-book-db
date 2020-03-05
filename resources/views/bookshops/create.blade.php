@extends('layout', [
  'title' => 'Create new bookshop'
])

@section('headline')
  <h2>Create new bookshop</h2>
@endsection

@section('content')

@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="/bookshops" method="post">
@csrf
  <input type="text" name="name" placeholder="Bookshop name">
  <input type="text" name="city" placeholder="City">
  <input type="submit">
</form>

@endsection
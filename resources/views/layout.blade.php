<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{$title}}</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="{{asset('css/app.css')}}" type="text/css"> 
</head>
<body>

<nav>
  <a href="{{ action('BookExampleController@index') }}">List of Books</a> |
  <a href="{{ action('PublisherController@index') }}">List of Publishers</a> |
  <a href="{{ action('BookshopController@index') }}">List of Bookshops</a> |
  <a href="{{ action('GenreController@index') }}">List of Genres</a> |
  <a href="{{ action('CartController@index') }}">View Cart</a> |
  <a href="{{ action('CartController@emptycart') }}">Empty Cart</a>
</nav>

  @yield('headline')
  @yield('content')
  @yield('listreviews')
  @yield('review')
  @yield('bottomnav')


</body>
</html>

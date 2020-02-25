<form action="/publishers" method="post">
@csrf
  <input type="text" name="title">
  <input type="submit">
</form>

{{-- there needs to be a @csrf tag, or it won't produce a token and will return a 419 error --}}
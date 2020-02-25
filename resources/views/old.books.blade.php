<h1>Hello World!</h1>

<?php echo 'Hello, ' . $user . ' ' . $surname . ' from php!'; ?>

<!-- having a Blade file, this is the same as... -->

<p>Hello {{ $user }} {{ $surname }} from php</p>

{{-- This is a comment that does not get shown on the source code of the page --}} 

{{-- TODO: something (not sure it works on vsc) --}} 

{{-- Using ifs --}} 

@if($age > 70)
  <p>You're too old</p>
  @if($age >= 18)
    <p>Ok, you can enter</p>
  @else
    <p>go back, kiddo</p>
@endif
@endif

{{-- Using for loops. We're including the code that is in book_detail.blade.php. It will render the view for each book. Same logic as nesting components in React. --}}

@foreach ($books as $book)
  @include('book_detail')
@endforeach
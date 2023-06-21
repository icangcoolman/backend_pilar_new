<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title_page}}</title>
    <meta name="author" content="Backend Pilar">
    <meta name="csrf-token" content="{{csrf_token()}}" />
    {{-- <link rel="stylesheet" href="./style.css"> --}}
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<style>
  a{ text-decoration: none;}
</style>
  </head>
  <body>
    {{-- <main>
        <h1>{{ $title}}</h1>  
    </main> --}}

    @include('partials.header')

    @yield('container')

    @include('partials.footer')

	{{-- <script src="index.js"></script> --}}

  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

  </body>
</html>
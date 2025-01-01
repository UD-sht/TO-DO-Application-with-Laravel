<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Uday Shrestha">
    <meta name="email" content="udshrestha48@gmail.com">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title')</title>
    <!--Core CSS -->
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">
    <link rel="stylesheet" href="{!! asset('stylesheets/style.css') !!}">
</head>

<body>
<div class="bg-light">
    @yield('page-content')
</div>

<script src="{!! asset('js/app.js') !!}"></script>
@stack('scripts')
</body>

</html>

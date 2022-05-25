<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Javokhir Abdufattokhov">
    <title>Contacts</title>
    <!-- Fonts -->
    <link href="{{ asset('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap')}}" rel="stylesheet">

    <script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
    <!-- bootstrap -->
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js')}}" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link href="{{ asset('css/main.css')}}" rel="stylesheet">
   
</head>
<body>

<!-- main content -->
<main class="container-fluid">
    @yield('content')
</main>
@yield('scripts')
</body>
</html>

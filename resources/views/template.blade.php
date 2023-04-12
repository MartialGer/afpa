<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <!--  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> -->
    <script src="/js/script.js"></script>
    <link rel="stylesheet" href="{{ asset('public/css/stylePrev.css') }}">
    <link rel="stylesheet" href="public/css/stylePrev.css">
    @yield('styles')			
    @yield('scripts')
</head>
<body>
    <div class="container">
        @yield('content')
        @yield('scripts')
        @yield('scripts2')

       </div>
</body>
</html>

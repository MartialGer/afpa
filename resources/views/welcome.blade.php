<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
        @vite(['resources/css/evenements.css'])
        <title>Projet AFPA</title>                    
    </head>

    <body class="antialiased">

    <div class="parent">
        <div class="News"> <a href="{{ route('news.index') }}"> <img src="/Images/News.png" alt=""> News </a></div>
        <div class="Agenda"><a href="{{ route('articles.index') }}"> <img src="/Images/Agenda.png" alt=""> Agenda </a></div>
        <div class="Météo"><a href="{{route('meteo_previsionnel')}}"> @yield('meteo')</a></div>
        <div class="NotedeService"><a href="{{route('indexNDS')}}" ><img src="/Images/Notes.png" alt=""> Note de Service </a></div>
        <div class="Informations"><a href="{{route('indexRCS')}}"> <img src="/Images/information.png" alt=""> Informations</div>
        <div class="Evenements"> <a href="{{ route('evenements.indexUser') }}"> <img src="/Images/Evenement.png" alt=""> Evenement </a></div>
        <div class="Logo"> <img src="/Images/LOGO-AFPA.png" alt=""></div>
    </div>
  
    </body>
</html>
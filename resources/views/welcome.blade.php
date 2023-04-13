<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/evenements.css'])
        <link rel="stylesheet" href="{{asset('css/welcome.css')}}">

        <title>Laravel</title>

        

     
      

        
    </head>
    <body class="antialiased">
    <!-- <form  class="px-5 " action="{{ route('evenements.index') }}" method="GET" enctype="multipart/form-data">
            @csrf
           
            <button>index</button>
        </form> -->

        <!-- <a href="{{ route('articles.admin.index') }}">Agenda Admin</a> -->
        <!-- <a href="{{ route('articles.index') }}">Agenda</a><br><br> -->
        
        <!-- <a href="{{ route('news.admin.index') }}">News Admin</a> -->
        <!-- <a href="{{ route('news.index') }}">News</a><br><br> -->
        <!-- <a href="{{ route('evenements.indexUser') }}">indexUser</a> -->
   
    <div class="parent">
        <div class="News"> <a href="{{ route('news.index') }}"> <img src="/Images/News.png" alt=""> News </a></div>
        <div class="Agenda"><a href="{{ route('articles.index') }}"> <img src="/Images/Agenda.png" alt=""> Agenda </a></div>
        <div class="Météo"> <img src="/Images/Météo.png" alt=""> Météo </div>
        <div class="NotedeService"> <img src="/Images/Notes.png" alt=""> Note de Service </div>
        <div class="Informations"> <img src="/Images/information.png" alt=""> Informations</div>
        <div class="Evenements"> <a href="{{ route('evenements.indexUser') }}"> <img src="/Images/Evenement.png" alt=""> Evenement </a></div>
        <div class="Logo"> <img src="/Images/LOGO-AFPA.png" alt=""></div>
    </div>
       
                </div>
            </div>
        </div>
    </body>
</html>
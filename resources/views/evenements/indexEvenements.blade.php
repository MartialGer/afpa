<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/evenements.css', 'resources/js/evenementIndexUser.js'])
</head>

<body class="bg-green-700 flex justify-center">
    <div class="bg-white w-11/12 my-10 rounded-lg flex flex-col items-center shadow-xl ">

        <!--  bloc du haut -->

        <div class="w-11/12 flex flex-col items-center sm:items-start gap-5 mt-5">
            <a href="{{route('dashboard')}}">Retour sur le menu</a>
            <h1 class="bg-green-600 w-full h-14 md:h-20 text-center text-white text-xl md:text-4xl font-bold rounded-lg flex items-center justify-center">Le journal de l'AFPA</h1>
            <input class="w-9/12 sm:w-72 lg:w-96 rounded-xl shadow-md shadow-gray-300" type="text" placeholder="rechercher..." id="rechercher">
        </div>

        <!-- bloc des articles -->

        <div class="w-10/12 flex flex-col items-center justify-center mb-5">
            @foreach ($evenements as $evenement)
            @if ($evenement['etat_id'] === 2 && $evenement['visibilite_id'] === 3)
            <a class="w-full max-w-5xl" href="{{ route('evenements.showUser', ['evenement' => $evenement['id']]) }}">
                <article class="flex flex-col md:flex-row rounded-xl mt-8 w-full justify-center items-center shadow-lg">
                <!-- image -->
                    <div class="md:w-4/12 flex justify-center items-center p-2">
                        @php
                        $imageExist = false;
                        @endphp

                        @foreach ($images as $image)
                        @if ($evenement['id'] == $image['evenement_id'])
                        <img class="w-36 sm:w-40" id="imagePreview" src="{{  asset($image['chemin']) }}" alt="image">
                        @php
                        $imageExist=true;
                        @endphp

                        @endif

                        @endforeach

                        @if ($imageExist == false)
                        <img class="w-36 sm:w-40" id="imagePreview" src="{{  asset('storage/imagesEvenement/logo-afpa.jpg') }}" alt="imageAfpa">
                        @endif
                    </div>
                <!--  text -->
                    <div class="w-11/12 md:w-8/12 m-5 ">
                        <h1 class="font-bold ">{{$evenement['titre']}}</h1>
                        @if ($evenement['resume'] !== null)
                        <p class="overflow-ellipsis overflow-hidden truncate">{{$evenement['resume']}}</p>
                        @else
                        <p>{{$evenement['contenu']}}</p>
                        @endif
                    </div>
                </article>
            </a>
            @endif
            @endforeach
        </div>

        {{ $evenements->links() }}
    </div>
</body>



</html>
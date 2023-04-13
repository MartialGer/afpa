<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/evenements.css', 'resources/js/evenement.js'])
</head>

<body class="bg-vert-fonce flex justify-center">
    <div class="bg-white w-11/12 my-8 rounded-2xl flex flex-col items-center shadow-xl pb-20">
        <div class="m-5 rounded-xl w-11/12 max-w-4xl">

            <!-- partie haute -->

            <div class="m-5 justify-self-start place-self-start">
                <a class="w-11/12 flex mt-6" href="{{ route('evenements.indexUser') }}"> <button>
                    <svg class='mr-2' width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="10" cy="10" r="10" fill="black" />
                        <path d="M11 6L7 10L11 14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <span class='text-sm'>Retour</span>
            </a>
                <h1 class="text-4xl mt-5 font-Kanit">{{$evenement[0]['titre']}}</h1>
                <span class="text-sm">Publié le {{$evenement[0]['created_at']}}</span>
            </div>

            <!-- article -->

            <div class="m-5 max-w-4xl">
                <p>{{$evenement[0]['resume']}}</p>

                <!-- Template 1   ---------------------------- -->

                @if ($evenement[0]['template_id'] == 1)
                <div class="w-48 sm:w-72 md:w-78 flex mx-auto my-5">
                    @if (isset($image[0]['chemin']))
                    <img id="imagePreview" src="{{  asset($image[0]['chemin']) }}" alt="image">

                    @else
                    <img id="imagePreview" src="{{  asset('storage/imagesEvenement/logo-afpa.jpg') }}" alt="sdfsdfsd">
                    @endif
                </div>

                <p>
                    @php
                    echo($evenement[0]['contenu'])
                    @endphp
                </p>

                <div class="flex mx-auto my-5 justify-center">
                    @if (isset($video[0]['chemin']))

                    <iframe id="vidPreview" class="w-56 sm:w-72 sm:h-48 md:w-96 md:h-56 " src="https://www.youtube.com/embed/{{ $video[0]['chemin'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

                    @endif
                </div>
                @endif

                <!-- Template 2   ---------------------------- -->

                @if ($evenement[0]['template_id'] == 2)
                <div class="flex mx-auto my-5 justify-center">
                    @if (isset($video[0]['chemin']))

                    <iframe id="vidPreview" class="w-56 sm:w-72 sm:h-48 md:w-96 md:h-56 " src="https://www.youtube.com/embed/{{ $video[0]['chemin'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

                    @endif
                </div>
                <p>{{$evenement[0]['contenu']}}</p>
                <div class="w-48 sm:w-72 md:w-78 flex mx-auto my-5">
                    @if (isset($image[0]['chemin']))
                    <img id="imagePreview" src="{{  asset($image[0]['chemin']) }}" alt="image">

                    @else
                    <img id="imagePreview" src="{{  asset('storage/imagesEvenement/logo-afpa.jpg') }}" alt="sdfsdfsd">
                    @endif
                </div>
                @endif

                <!-- Template 3   ---------------------------- -->

                <!-- Template 4   ---------------------------- -->

                <!-- Fin templates   ---------------------------- -->


            </div>
        </div>
    </div>
</body>

</html>
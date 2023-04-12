<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/evenements.css', 'resources/js/evenement.js'])
</head>

<body class="bg-green-700 flex justify-center">
    <div class="bg-white w-11/12 min-h-screen my-8 rounded-2xl flex flex-col items-center shadow-xl ">
        <div class="shadow-xl m-5 rounded-xl min-h-screen w-11/12 max-w-4xl">
            <!-- partie haute -->
            <div class="m-5 justify-self-start place-self-start">
                <a href="{{ route('evenements.indexUser') }}">index journal</a>
                <h1 class="text-4xl mt-2 ">{{$evenement[0]['titre']}}</h1>
                <span>{{$evenement[0]['created_at']}}</span>
            </div>

            <!-- article -->
            <div class="m-5 max-w-4xl">
                <p>{{$evenement[0]['resume']}}</p>
                <div class="w-48 sm:w-72 md:w-78 flex mx-auto my-5">
                    @if (isset($image[0]['chemin']))
                    <img id="imagePreview" src="{{  asset($image[0]['chemin']) }}" alt="image">

                    @else
                    <img id="imagePreview" src="{{  asset('storage/imagesEvenement/logo-afpa.jpg') }}" alt="sdfsdfsd">
                    @endif
                </div>
                <p>{{$evenement[0]['contenu']}}</p>

                <div class="flex mx-auto my-5 justify-center">
                    @if (isset($video[0]['chemin']))

                    <iframe id="vidPreview" class="w-56 sm:w-72 sm:h-48 md:w-96 md:h-56 " src="https://www.youtube.com/embed/{{ $video[0]['chemin'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>
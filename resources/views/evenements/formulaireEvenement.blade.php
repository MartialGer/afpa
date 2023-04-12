<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.ckeditor.com/4.21.0/basic/ckeditor.js"></script>

    @vite(['resources/css/evenements.css', 'resources/js/evenementModification.js'])
</head>

<body class="flex flex-col items-center">
    <main class="w-[95vw]  max-w-7xl  p-5 bg-white shadow-2xl">
        <h1 class="text-center text-2xl w-72 p-5 border mx-auto"> @if ( isset($evenement)) Modifier évènement "{{$evenement[0]['titre']}}" @else Nouvel évènement @endif</h1>
        <form id="evenementForm" class="mx-5 " action=" @if ( isset($evenement)) {{ route('evenements.update', ['evenement' => $evenement[0]['id']]) }} @else {{ route('evenements.store')}} @endif" method="POST" enctype="multipart/form-data" class="flex flex-col" onkeydown="return event.key != 'Enter'; ">
            @csrf

            @if ( isset($evenement))
            @method('PUT')
            @endif

            <!-- Partie Haute -->

            <div class="flex flex-row justify-between gap-6 w-full mt-14">
                <div class="w-9/12">
                    <h2>Titre</h2>
                    <input class="w-10/12" type="text" name="titre" placeholder="Titre de l'article" @if ( isset($evenement)) value="{{$evenement[0]['titre']}}" @endif required>
                    <h2>Résumé</h2>
                    <textarea class="h-28 w-10/12" type="text" name="resume" placeholder="Contenu de l'article" id="editor1" required>@if ( isset($evenement)) {{$evenement[0]['resume']}} @endif</textarea>
                    <h2>Contenu</h2>
                    <textarea class="h-36 w-full" type="text" name="contenu" placeholder="Contenu de l'article" id="editor2" required>@if ( isset($evenement)) {{$evenement[0]['contenu']}} @endif</textarea>

                </div>
                <div class="w-3/12 h-full">
                    <h2>Mise en page</h2>
                    <div class="border-2 rounded-md p-3 flex flex-col items-center">
                        @foreach ($templates as $template)
                  
                        <span class="font-bold mx-auto">{{$template->nom}}</span>
                        <div class="flex justify-center items-center gap-4 mb-2 ">
                            <input type="radio" name="template" value="{{$template->id}}" @if( isset($evenement) && $evenement[0]['template_id']==$template->id) checked @elseif ($template->id == 1) checked @endif>
                            <img class="object-fill border-2 rounded-md w-40 h-40" src="{{asset($template['preview'])}}" alt="{{$template->id}}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <!-- Partie basse -->
            <div class="flex gap-20 w-9/12 justify-evenly mt-8">
                <div class="flex flex-col w-72 ">
                    <div id="imageInputDiv" class="hidden flex flex-col items-center mb-5">
                        <span>Inserer une image</span>
                        <div class="bg-blue-500 w-48 h-10 flex justify-center items-center">
                            <label for="image">Upload</label>
                        </div>

                        <input type="file" id='image' name="image" accept="image/*" class="hidden">
                        <input type="text" name='imageDeleted' class="hidden" id='imageDeleted' value='0'>
                    </div>
                    <div class="flex flex-col w-72 gap-5 items-center">
                        @if (isset($image[0]['chemin']))

                        <x-bouton-suppr id="imageDelete">supprimer l'image</x-bouton-suppr>
                        <img id="imagePreview" src="{{  asset($image[0]['chemin']) }}" alt="image">
                        @else
                        <img id="imagePreview" alt="">
                        @endif
                    </div>


                </div>
                <div class="flex flex-col  w-72 gap-5 items-center">
                    <div id="videoInputDiv" class="hidden flex flex-col items-center mb-5">
                        <label for="urlVid">URL d'une vidéo</label>
                        <input type="text" id="urlVid" name="urlVid" @if (isset($video[0]['chemin'])) value="https://www.youtube.com/embed/{{ $video[0]['chemin'] }}" @endif>
                        <input type="text" name='videoDeleted' class="hidden" id='videoDeleted' value='0'>
                    </div>
                    @if (isset($video[0]['chemin']))
                    <x-bouton-suppr id="videoDelete">supprimer la vidéo</x-bouton-suppr>
                    <iframe id="vidPreview" width="250" height="150" src="https://www.youtube.com/embed/{{ $video[0]['chemin'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    @else
                    <iframe class="hidden" id="vidPreview" width="250" height="150" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    @endif
                </div>
            </div>


            <div class="flex gap-6 mt-5">
                <select name="etat" id="etat" class="w-72">
                    @foreach ($etats as $etat)
                    <option value="{{ $etat->id }}" @if (isset($evenement) && $evenement[0]['etat_id']==$etat->id) selected @endif>
                        {{ $etat->nom }}
                    </option>
                    @endforeach
                </select>
                <select name="visibilite" id="visibilite" class="w-72">
                    @foreach ($visibilites as $visibilite)
                    <option value="{{ $visibilite->id }}" @if (isset($evenement) && $evenement[0]['visibilite_id']==$visibilite->id) selected @endif>
                        {{ $visibilite->nom }}
                    </option>
                    @endforeach
                </select>
                <x-bouton-valider>Valider</x-bouton-valider>
        </form>
        <form method="get" action="{{ route('evenements.index')}}">
            <x-bouton-annuler>annuler</x-bouton-annuler>
        </form>



        </div>


    </main>
</body>

<script>

</script>


</html>
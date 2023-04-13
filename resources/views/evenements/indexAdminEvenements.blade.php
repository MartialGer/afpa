<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/evenements.css', 'resources/js/evenement.js'])
</head>

<body class='font-roboto flex flex-col items-center'>
    <a class='w-11/12 flex mt-6' href="{{route('dashboard')}}">
        <button>
            <svg class='mr-2' width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="10" cy="10" r="10" fill="black" />
                <path d="M11 6L7 10L11 14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        <span class='text-sm'>Retour</span>
    </a>


    <h1 class='w-11/12 h-16 my-2 rounded font-Kanit text-4xl text-center flex items-center justify-center border-solid border-2 bg-gray-100 '>
        Gestion des évènements</h1>



    <div class='w-9/12 my-8 flex items-center justify-center gap-5'>


        <select class='w-1/3 rounded border-gray-200' name="visibilite" id="visibilite">
            <option value="all">Filtrer par état...</option>
            <option value="Publié">Publié</option>
            <option value="En cours">En cours</option>
            <option value="Archivé">Archivé</option>
        </select>

        <input class='w-1/3 rounded border-gray-200' type="text" id="rechercher" placeholder="Rechercher">

        <a class='w-1/3 border rounded-md' href="{{route ('evenements.create') }}"><span class='flex items-center'><x-bouton-creer></x-bouton-creer><span class='pl-3'>Créer un
                    article</span></span></a>

    </div>

    <div class='w-9/12 flex items-center justify-center'>
        <table id="tableEvenements" class="table-fixed w-full">
            <tr class='text-left'>
                <th class="px-4 w-1/12">Etat</th>
                <th class="w-20">Visibilité</th>
                <th class="px-4 w-2/12">Date</th>
                <th class="px-4 w-2/7">Titre</th>
                <th class="px-4 w-10"></th>
                <th class=""></th>
                <th class=""></th>
            </tr>

            @foreach ($evenements as $evenement)

            <tr class='border-collapse bg-gray-50 '>
                <td class='px-4 border-l-2 border-y-2 border-gray-200 border-solid'>{{$evenement->etat->nom}}</td>
                <td class='border-y-2 border-gray-200 border-solid'>{{$evenement->visibilite->nom}}</td>
                <td class='px-4 border-y-2 border-gray-200 border-solid'>{{$evenement->created_at->format('D,M,Y')}}
                </td>
                <td class='px-4 border-y-2 border-gray-200 border-solid truncate ...'>{{$evenement['titre']}}</td>
                <td class='px-4 border-r-2 border-y-2 border-gray-200 border-solid'>{{$evenement->id}}</td>

                <td class='px-5 border-r-0'> <a href="{{route ('evenements.edit', ['evenement' => $evenement->id]) }}"><x-bouton-modif>modifier</x-bouton-modif></a>
                </td>
                <td class='border-r-0'>
                    <form action="{{ route('evenements.destroy',$evenement->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <x-bouton-suppr id="supprBouton" onclick="confirmDelete(event)">Supprimer</x-bouton-suppr>
                    </form>

                </td>
            </tr>

            <tr class="h-4">
                <td></td>
            </tr>

            @endforeach
        </table>

    </div>

    <div class='w-9/12 flex mt-4'>
        <x-bouton-suppr>Nettoyer</x-bouton-suppr>
    </div>

    <br><br><br><br><br>

</body>

<script>
      function confirmDelete() {
        if (window.confirm("Confirmer la suppression de l'évènement ?")) {

        } else {
            event.preventDefault();
        }
    }
</script>

</html>
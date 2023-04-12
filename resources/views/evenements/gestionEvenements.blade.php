<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/js/evenementFormulaire.js'])
</head>

<body>
    <a href="{{route('dashboard')}}">
        <button>
            < </button>
                <span>Retour à l'index admin</span>
    </a>
    <h1>Gestion des évènements</h1>
    <div>


        <select name="visibilite" id="visibilite" onchange="filterTable()">>
            <option value="all">Filtrer par état...</option>
            <option value="publié">publié</option>
            <option value="non publié">non publié</option>
            <option value="archivé">archivé</option>
        </select>

        <input type="text" id="rechercher" placeholder="Rechercher" oninput="rechercher()">

        <a href="{{route ('evenements.create') }}"><span><button>+</button><span>Créer un article</span></span></a>

    </div>

    <div class="flex flex-row ">
        <table id="tableEvenements">
            <tr>
                <th>Etat</th>
                <th>Visibilité</th>
                <th>Date</th>
                <th>Titre</th>
            </tr>

            @foreach ($evenements as $evenement)

            <tr>
                <td>{{$evenement->etat->nom}}</td>
                <td>{{$evenement->visibilite->nom}}</td>
                <td>{{$evenement->created_at->format('D,M,Y')}}</td>
                <td>{{$evenement['titre']}}</td>
                <td>{{$evenement->id}}</td>

                <td> <a href="{{route ('evenements.edit', ['evenement' => $evenement->id]) }}"><button>modifier</button></a></td>
                <td>
                    <form class="px-5 " action="{{ route('evenements.destroy',$evenement->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <button onclick="confirmDelete(event)">Supprimer</button>
                    </form>

                </td>
            </tr>

            @endforeach
        </table>

        <button>Nettoyer</button>
    </div>

    <br><br><br><br><br>

    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

</body>

<script>
    function rechercher(){
        let input = document.getElementById("rechercher");
        let value = input.value;
        let table = document.getElementById("tableEvenements");
        let rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            let cible = rows[i].getElementsByTagName("td")[3];
          
            if (value === "" || cible.textContent.includes(value)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    function filterTable() {
        let select = document.getElementById("visibilite");
        let filterValue = select.value;
        let table = document.getElementById("tableEvenements");
        let rows = table.getElementsByTagName("tr");


        for (let i = 1; i < rows.length; i++) {
            let visibilite = rows[i].getElementsByTagName("td")[0];
            console.log(visibilite);
            if (filterValue === "all" || visibilite.textContent === filterValue) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    function confirmDelete() {
        if (window.confirm("Confirmer la suppression")) {

        } else {
            event.preventDefault();
        }
    }
</script>

</html>
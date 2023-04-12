@extends('template')

@section('content')

    <form action="{{ url('admin/meteo') }}" method="POST">

<form action="{{ url('meteo/admin') }}" method="POST">


        @csrf
        <label for="city">Entrez la ville pour la météo : </label>
        <input type="text" name="city" id="city">
        <input type="submit" value="Envoyer !">
    </form>

    @if (isset($error))
        @if ($error == 1)
            <p>Erreur, la base de données est inaccessible</p>
        @elseif ($error == 2)
            <p>Veuillez choisir une ville existante</p>
        @endif
    @elseif (isset($data))
        <p>La ville {{ $data->ville }} à bien été prit en compte</p>
    @endif
    
@endsection

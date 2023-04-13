@extends('template')

@section('content')
<div class="h-screen w-screen" style="background-color:#00A0E0">
<form action="{{ url('admin/meteo') }}" method="POST" class="flex flex-col">
  @csrf
  <div class="mt-5 ml-5 mb-5 mr-auto inline-block border-2 border-solid border-black rounded-3xl " style="background-color:#FDF8F8">
  <h1 class="m-4 text-4xl" style="color:#161616;">Météo</h1>
</div>

  <div class="ml-5 flex items-center">
    <input type="text"  id="city" name="city" class="block w-64 rounded-full border-2 border-black p-2" placeholder="choisissez une ville">
    <input type="submit" class="block w-40 rounded-full bg-blue-500 text-white p-2 ml-2 border-2 border-solid  border-black" value="Envoyer">
  </div>
  @if (isset($error))
    @if ($error == 1)
      <p>Erreur, la base de données est inaccessible</p>
    @elseif ($error == 2)
      <p>Veuillez choisir une ville existante</p>
      @endif
     @elseif (isset($data))
    <p>La ville de {{ $data->ville }} a bien été prise en compte</p>
  @endif
</form>
</div>

@endsection
@extends('template')

@section('content')

<body style="background-color: #87BB34">
    <div>
        @if(isset($note_de_service))
        <div class="flex justify-center items-center bg-white border-2 border-solid border-black rounded-3xl m-20">
            <div>
                <h1 class="text-4xl uppercase">Modification note de service</h1>
                <p>Vous pouvez modifier la note de service n° {{ $note_de_service->id }} ci-dessous</p>
            </div>
            <img src="{{ asset('images/afpa.jpg') }}" alt="logo AFPA" width="200" height="200">
        </div>
        <form action="{{ route('updateNDS', ['slug' => $note_de_service['slug']]) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @else
            <div class="flex justify-center items-center bg-white border-2 border-solid border-black rounded-3xl m-20">
                <div>
                    <h1 class="text-4xl uppercase">Ajout note de service</h1>
                    <p>Vous pouvez ajouter une nouvelle note de service en remplissant le formulaire ci-dessous.</p>
                </div>
                <img src="{{ asset('images/afpa.jpg') }}" alt="logo AFPA" width="200" height="200">
            </div>
            @endif
            <div class="bg-white rounded-2xl m-20 p-10 shadow-2xl">
                <form action="{{ route('saveNDS') }}" method="post" enctype="multipart/form-data" class="flex justify-evenly">
                    @csrf
                    <div class="text-center">
                        <div class="m-4">
                            <label for="titre">Titre</label>
                            <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" required value="{{ isset($note_de_service) ? $note_de_service->titre : old('titre') }}">
                            @error('titre')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="m-4 p-4">
                            <label for="pdf">PDF</label>
                            @if(isset($note_de_service))
                            <p>Le fichier PDF actuel est :</p>
                            <embed src="{{ Storage::url($note_de_service['pdf']) }}.#toolbar=0" type="application/pdf" width="100%" height="600px" />
                            <input type="file" class="form-control @error('pdf') is-invalid @enderror" id="pdf" name="pdf">
                            @else
                            <input type="file" class="form-control @error('pdf') is-invalid @enderror" id="pdf" name="pdf" required>
                            @endif
                            @error('pdf')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div>

                        <div class="m-4 p-4">
                            <label for="auteur">Auteur</label>
                            <input type="text" class="form-control @error('auteur') is-invalid @enderror" id="auteur" name="auteur" required value="{{ isset($note_de_service) ? $note_de_service->auteur : old('auteur') }}">
                            @error('auteur')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <label for="date_creation">Date de création</label>
                            <input type="date" class="form-control @error('date_creation') is-invalid @enderror" id="date_creation" name="date_creation" required value="{{ isset($note_de_service) ? $note_de_service->date_creation : old('date_creation') }}">
                            @error('date_creation')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <label for="etat">État</label>
                            <select class="form-control" id="etat" name="etat">
                                @foreach ($etats as $etat)
                                <option value="{{ $etat->id }}" @if(isset($note_de_service) && $note_de_service->etat_id == $etat->id) selected @endif>{{ $etat->nom }}</option>
                                @endforeach
                            </select>
                            <label for="visibilite">Visibilité</label>
                            <select class="form-control" id="visibilite" name="visibilite">
                                @foreach ($visibilites as $visibilite)
                                <option value="{{ $visibilite->id }}" @if(isset($note_de_service) && $note_de_service->visibilite_id == $visibilite->id) selected @endif>{{ $visibilite->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary bg-green-600 rounded-xl m-2 p-2 text-white">{{ isset($note_de_service) ? 'Modifier | #' : 'Valider | √' }}</button>
                            <button type="reset" class="bg-red-600 rounded-xl m-2 p-2 text-white">Annuler | X</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
    @endsection
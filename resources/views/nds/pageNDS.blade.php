@extends('template')

@section('content')
    <div>
        <h1>{{ $note_de_service->titre }}</h1>
        <p>Auteur : {{ $note_de_service->auteur }}</p>
        <p>Date de création : {{ $note_de_service->date_creation }}</p>
        <embed src="{{ Storage::url($note_de_service['pdf']) }}.#toolbar=0" type="application/pdf" width="100%" height="600px" />
    </div>
@endsection

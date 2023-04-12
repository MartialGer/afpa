@extends('templateFormulaire')

@section('content')
    <div>
        <h1>{{ $reglement->titre }}</h1>
        @if (isset($error))
            <div>{{ $error }}</div>
        @else
            <div>
                @if (isset($reglement->pdf))
                    <embed src="{{ Storage::url($reglement['pdf']) }}.#toolbar=0" type="application/pdf" width="100%" height="600px"/>
                @else
                    Aucun fichier
                @endif
            </div>
        @endif
    </div>
@endsection
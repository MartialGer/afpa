@extends('template')

@section('content')
    <div>
        <h1>Règlements</h1>
        @if (isset($error))
            <div>{{ $error }}</div>
        @else
            @if (session('success'))
                <div>{{ session('success') }}</div>
            @endif
            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reglements as $reglement)
                        <tr>
                            <td><td><a href="{{ route('pageRCS', str_replace(' ', '_', $reglement->titre)) }}">{{ $reglement->titre }}</a></td></td>
                            <td>
                                @if (isset($reglement->pdf))
                                <embed src="{{ Storage::url($reglement['pdf']) }}.#toolbar=0" type="application/pdf" width="100%" height="600px"/>
                                @else
                                    Aucun fichier
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

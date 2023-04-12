@extends('templateFormulaire')

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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Règlement intérieur</td>
                        <td>
                            @php
                                $reglement = $reglements->firstWhere('titre', 'Règlement intérieur');
                            @endphp
                            @if (isset($reglement) && isset($reglement['pdf']))
                             <embed src="{{ Storage::url($reglement['pdf']) }}.#toolbar=0" type="application/pdf" width="100%" height="600px" />
                            @else
                                Aucun fichier
                            @endif
                        </td>
                        <td>
                            @if (isset($reglement) && isset($reglement['pdf']))
                                <a href="{{ route('selectRCS', ['slug' => $reglement->slug]) }}">Modifier</a>
                            @else
                                <a href="{{ route('createRCS', ['titre' => 'Règlement intérieur']) }}">Ajouter</a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Sécurité incendie</td>
                        <td>
                            @php
                                $reglement = $reglements->firstWhere('titre', 'Sécurité incendie');
                            @endphp
                            @if (isset($reglement) && isset($reglement['pdf']))
                             <embed src="{{ Storage::url($reglement['pdf']) }}.#toolbar=0" type="application/pdf" width="100%" height="600px" />
                            @else
                                Aucun fichier
                            @endif
                        </td>
                        <td>
                            @if (isset($reglement) && isset($reglement['pdf']))
                                <a href="{{ route('selectRCS', ['slug' => $reglement->slug]) }}">Modifier</a>
                            @else
                                <a href="{{ route('createRCS', ['titre' => 'Sécurité incendie']) }}">Ajouter</a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <td>Certification</td>
                        <td>
                            @php
                                $reglement = $reglements->firstWhere('titre', 'Certification');
                            @endphp
                            @if (isset($reglement))
                                @if (isset($reglement['pdf']))
                                <embed src="{{ Storage::url($reglement['pdf']) }}.#toolbar=0" type="application/pdf" width="100%" height="600px" />
                                @else
                                    Aucun fichier
                                @endif
                            @else
                                Aucun fichier
                            @endif
                        </td>
                        <td>
                            @if (isset($reglement))
                                <a href="{{ route('selectRCS', ['slug' => $reglement['slug']]) }}">Modifier</a>
                            @else
                                <a href="{{ route('createRCS', ['titre' => 'Certification']) }}">Ajouter</a>
                            @endif
                        </td>

                    </tr>
                </tbody>
            </table>            
        @endif
    </div>        
@endsection
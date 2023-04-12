@extends('template')
 
@section('content')
@if (isset($error))
        @if ($error == 1)
            <p>Erreur, la base de données est inaccessible</p>
        @elseif ($error == 2)
            <p>Veuillez choisir une ville existante</p>
        @endif
    @elseif (isset($data))    

    @php
        $heure = ltrim(\Carbon\Carbon::now()->format('H'), '0');
        $meteo = json_decode($data->json);
    @endphp

<table>
    <tr>
        <td><img src="{{ $meteo->fcst_day_0->hourly_data->{$heure.'H00'}->ICON }}" alt="Icone du temps"></td>
        <td>{{ $meteo->fcst_day_0->hourly_data->{$heure.'H00'}->TMP2m }}°C</td>
    </tr>
</table>

    @endif
@endsection

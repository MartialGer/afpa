<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelMeteo;
use Carbon\Carbon;


class CtrlMeteo extends Controller
{
    public function afficherFormulaire()
    {
        return view('meteo.formulaireMeteo');
    }

    public function selectVilleMeteo(Request $request)
    {
        $city = $request->input('city');
        $data = ModelMeteo::selectVilleMeteoApi($city);

        if ($data === 1) {
            $error = 1;
            return view('meteo.formulaireMeteo', compact(['error'])); // vue erreur serveur
        }

        if ($data === 2) {
            $error = 2;
            return view('meteo.formulaireMeteo', compact(['error'])); // vue erreur ville
        }

        return view('meteo.formulaireMeteo', compact(['data']));
    }
    public function afficherWidgetMeteo()
    {

        $data = ModelMeteo::selectAllVilleMeteo();

        if ($data === 1) {
            $error = 1;
            return view('meteo.meteoWidget', compact(['error'])); // vue erreur serveur
        }

        if ($data === 2) {
            $error = 2;
            return view('meteo.meteoWidget', compact(['error'])); // vue erreur ville
        }

        $city = $data->ville;
        $lastUpdate = Carbon::createFromFormat('Y-m-d H:i:s', $data->updated_at);
        $currentTime = Carbon::now();
        $diffInMinutes = $lastUpdate->diffInMinutes($currentTime);

        // echo $lastUpdate, '--', $currentTime, '--', $diffInMinutes;

        if ($diffInMinutes > 60) {
            ModelMeteo::selectVilleMeteoApi($city);
            $data = ModelMeteo::selectAllVilleMeteo();
        }
        return view('meteo.meteoWidget', compact(['data']));
    }
    public function afficherPrevMeteo()
    {
        $data = ModelMeteo::selectAllVilleMeteo();

        if ($data === 1) {
            $error = 1;
            return view('meteo.meteoPrev', compact(['error'])); // vue erreur serveur
        }

        if ($data === 2) {
            $error = 2;
            return view('meteo.meteoPrev', compact(['error'])); // vue erreur ville
        }

        $city = $data->ville;
        $lastUpdate = Carbon::createFromFormat('Y-m-d H:i:s', $data->updated_at);
        $currentTime = Carbon::now();
        $diffInMinutes = $lastUpdate->diffInMinutes($currentTime);

        if ($diffInMinutes > 60) {
            ModelMeteo::selectVilleMeteoApi($city);
            $data = ModelMeteo::selectAllVilleMeteo();
        }
        return view('meteo.meteoPrev', compact(['data']));
    }
}




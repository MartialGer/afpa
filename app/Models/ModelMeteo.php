<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;class ModelMeteo extends Model
{
    use HasFactory;
    protected $table = 'meteo';
    protected $fillable = ['nom', 'ville', 'json', 'visibilite_id'];
    public static function selectVilleMeteoApi($city)
    {
        try {
            $response = Http::get('http://www.prevision-meteo.ch/services/json/' . $city);


            if (strpos($response->body(), 'errors') !== false) {
                return 2; // Erreur de ville 
            }

            self::updateOrCreate(['nom' => 'afpa'], ['ville' => $city, 'json' => $response->body(), 'visibilite_id' => 3]);
            $data = self::where('nom', 'afpa')->first();
            return $data;

        } catch (\Exception $e) {
            return 1; // Erreur d'accès à la base de données
        }       
    }
    public static function selectAllMeteo(){
        $data = self::where('nom', 'afpa')->first();

        return $data?$data->json: 'Aucune donnée n\'a été trouvée dans la base de données';

    }
    public static function selectAllVilleMeteo()
    {
        try {
            $data = self::where('nom', 'afpa')->first();
            return $data;
        } catch (\Exception $e) {
            return 1; // Erreur d'accès à la base de données
        }
    }
}
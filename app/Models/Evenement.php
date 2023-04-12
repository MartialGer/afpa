<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'evenements';

    protected $primaryKey = 'id';

    protected $fillable = [
        'titre',
        'resume',
        'contenu',
        'etat_id',
        'template_id',
        'visibilite_id',
    ];


    public static function lesEvenements(){
        $evenements = Evenement::select('*')
      
        ->get();

        return $evenements;
    }

    public static function cetEvenement($id){
        $evenement = Evenement::select('*')
        ->where('evenements.id', $id)
        ->get();

        return $evenement;
    }





    public function visibilite()
    {
        return $this->belongsTo(Visibilite::class);
    }
    public function etat()
    {
        return $this->belongsTo(Etat::class);
    }
    public function template()
    {
        return $this->belongsTo(Template::class);
    }
    public function media_evements()
	{
		return $this->hasMany(Media::class, 'evenement_id');
	}
}

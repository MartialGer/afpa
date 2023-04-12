<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'medias';

    protected $primaryKey = 'id';

    protected $fillable = [
		'chemin',
		'titre',
		'positionnement',
		'type_media_id',
		'evenement_id',
	
	];

    public static function lesMedias(){
		$images = Media::select('*')
		->join('type_medias', 'medias.type_media_id', '=', 'type_medias.id' )
		->get();

		return $images;
	}
    public static function lesImages(){
		$images = Media::select('*')
		->join('type_medias', 'medias.type_media_id', '=', 'type_medias.id' )
		->where('medias.type_media_id','=', 2)
		->get();

		return $images;
	}
    public static function cetteImage($id){
		$image = Media::select('*')
		->join('type_medias', 'medias.type_media_id', '=', 'type_medias.id' )		
		->where('medias.evenement_id', '=', $id)
		->where('medias.type_media_id','=', 2)
		->get();

		return $image;
	}

    public static function cetteVideo($id){
		$video = Media::select('*')
		->join('type_medias', 'medias.type_media_id', '=', 'type_medias.id' )		
		->where('medias.evenement_id', '=', $id)
		->where('medias.type_media_id','=', 1)
		->get();

		return $video;
	}
  

    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }

    public function type_media()
	{
		return $this->belongsTo(Type_media::class);
	}
}

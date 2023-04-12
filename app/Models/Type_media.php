<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_media extends Model
{
    use HasFactory;

    protected $table = 'type_medias';

    protected $fillable = [
		'nom',
		
	];

    public function media_evenements()
	{
		return $this->hasMany(Media_evenement::class);
	}
}

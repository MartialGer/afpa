<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visibilite extends Model
{
    use HasFactory;

    protected $table = 'visibilites';

    protected $fillable = [
		'nom',
		
	];

  public function evenements()
	{
		return $this->hasMany(Evenement::class);
	}

    
}

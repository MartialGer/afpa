<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $table = 'templates';

    protected $fillable = [
		'nom',
		'preview',
		
	];

    public function evenements()
	{
		return $this->hasMany(Evenement::class);
	}
}

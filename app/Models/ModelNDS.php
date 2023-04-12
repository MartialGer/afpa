<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Illuminate\Support\Str;

class ModelNDS extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'note_de_services';

    public function getSlugAttribute()
    {
        return Str::slug($this->titre, '_');
    }
    public function visibilite()
    {
        return $this->belongsTo(Visibilite::class);
    }
    public function etat()
    {
        return $this->belongsTo(Etat::class);
    }
}

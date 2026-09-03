<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mouvement extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = ['depart' => 'datetime', 'arrivee' => 'datetime'];

    public function getNombreMoyenAttribute()
    {
        return $this->nombre.' '.$this->moyen;
    }

    public function getStatutAttribute()
    {
        if($this->depart->gt(now()->timezone('Africa/Casablanca'))) {
            return 'Transport planifié';
        } elseif(!$this->arrivee) {
            return 'En cours de transport';
        }

        return 'Arrivée à destination';
    }
}

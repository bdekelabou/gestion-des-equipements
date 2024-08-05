<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etape extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
    ];

    public function problemes()
    {
        return $this->hasMany(Probleme::class, 'etapes_id');
    }
}

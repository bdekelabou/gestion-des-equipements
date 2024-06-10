<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BureauPoste extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function equipements()
    {
        return $this->hasMany(Equipement::class, 'bureau_postes_id');
    }
}

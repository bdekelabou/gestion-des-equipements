<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_equipement_id',
        'bureau_poste_id',
        "libelle"
    ];

    public function typeEquipement()
    {
        return $this->belongsTo(TypeEquipement::class, 'type_equipements_id');
    }

    public function bureauPoste()
    {
        return $this->belongsTo(BureauPoste::class, 'bureau_postes_id');
    }
}

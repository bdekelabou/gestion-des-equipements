<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_equipements_id',
        'bureau_postes_id',
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

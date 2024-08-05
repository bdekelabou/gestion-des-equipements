<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEquipement extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
    ];

    public function equipements()
    {
        return $this->hasMany(Equipement::class, 'type_equipements_id');
    }
}

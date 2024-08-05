<?php

namespace App\Models;

use App\Models\Demande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Probleme extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'etapes_id',
    ];

    public function etapes()
    {
        return $this->belongsTo(Etape::class, 'etapes_id');
    }

    public function demandes(): BelongsToMany
    {
        return $this->belongsToMany(Demande::class);
    }
}

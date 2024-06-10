<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

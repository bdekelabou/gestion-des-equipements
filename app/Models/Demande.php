<?php

namespace App\Models;

use App\Models\Probleme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Demande extends Model
{
    use HasFactory;

    public function problemes(): BelongsToMany
    {
        return $this->belongsToMany(Probleme::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
 
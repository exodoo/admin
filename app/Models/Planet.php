<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Planet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'image',
        'distance',
        'gravity',
        'temperature',
        'radius',
        'rotation_period',
        'orbital_period',
        'diameter',
    ];

    public function stars(): HasMany
    {
        return $this->hasMany(Star::class);
    }
}

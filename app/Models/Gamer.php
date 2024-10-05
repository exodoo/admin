<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string|null $email
 */
class Gamer extends Model
{
    use HasFactory;

    protected $fillable = [
            'username',
            'name',
            'email',
        ];

    public function planets(): BelongsToMany
    {
        return $this->belongsToMany(Exoplanet::class);
    }

    public function likePlanet(Exoplanet $planet): void
    {
        $this->planets()->attach($planet);
    }
}

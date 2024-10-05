<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string|null $email
 *
 * @property Collection|Exoplanet[] $exoplanets
 */
class Gamer extends Model
{
    use HasFactory;

    protected $fillable = [
            'username',
            'name',
            'email',
        ];

    public function exoplanets(): BelongsToMany
    {
        return $this->belongsToMany(Exoplanet::class);
    }

    public function likeExoplanet(Exoplanet $exoplanet): void
    {
        $this->exoplanets()->attach($exoplanet);
    }

    public function hasExoplanet(Exoplanet|int $exoplanet): bool
    {
        $id = $exoplanet instanceof Exoplanet ? $exoplanet->id : $exoplanet;

        return $this->exoplanets->first(fn(Exoplanet $item): bool => $id === $item->id) !== null;
    }
}

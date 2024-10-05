<?php

namespace App\Models;

use App\Models\Enums\ExoplanetType;
use App\Models\Enums\StarType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $type
 * @property string $image
 * @property float $mass
 * @property float $radius
 * @property float $temperature
 * @property float $age
 */
class Star extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'image',
        'mass',
        'radius',
        'temperature',
        'age',
    ];

    protected $casts = [
        'type' => StarType::class,
    ];

    public function exoplanets(): HasMany
    {
        return $this->hasMany(Exoplanet::class);
    }
}

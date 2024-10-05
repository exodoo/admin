<?php

namespace App\Models;

use App\Models\Enums\ExoplanetType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 * @property int id
 * @property string name
 * @property string|null description
 * @property float|null mass
 * @property float|null radius
 * @property float|null orbital_period
 * @property string|null semi_major_axis
 * @property float|null eccentricity
 * @property float|null temperature
 * @property float|null gravity
 * @property float|null density
 * @property boolean|null habitability
 * @property string|null surface_conditions
 * @property float|null age
 * @property float|null distance_from_earth
 * @property float|null travel_time
 * @property string|null discovered_method
 * @property string|null exoplanet_type
 * @property string|null planet_texture
 * @property string|null surface_photos
 * @property string|null locals_portrait
 * @property string|null flora_photos
 * @property string|null camp_photo
 * @property string|null background
 *
 * @property Star $star
 * @property Publication[] $publications
 */
class Exoplanet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'mass',
        'radius',
        'orbital_period',
        'semi_major_axis',
        'eccentricity',
        'temperature',
        'gravity',
        'density',
        'habitability',
        'surface_conditions',
        'age',
        'distance_from_earth',
        'travel_time',
        'discovered_method',
        'exoplanet_type',
        'planet_texture',
        'surface_photos',
        'locals_portrait',
        'flora_photos',
        'camp_photo',
        'background',
    ];

    protected $casts = [
        'type' => ExoplanetType::class,
        'habitability' => 'boolean',
    ];

    public function gamers(): BelongsToMany
    {
        return $this->belongsToMany(Gamer::class);
    }

    public function publications(): HasMany
    {
        return $this->hasMany(Publication::class);
    }

    public function star(): BelongsTo
    {
        return $this->belongsTo(Star::class);
    }
}

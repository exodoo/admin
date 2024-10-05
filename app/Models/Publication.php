<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $exoplanet_id
 * @property string $title
 * @property string $link
 * @property string|null $description
 * @property string|null $authors
 *
 * @property Exoplanet $exoplanet
 */
class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'link',
        'description',
        'authors',
    ];

    public function exoplanet(): BelongsTo
    {
        return $this->belongsTo(Exoplanet::class);
    }
}

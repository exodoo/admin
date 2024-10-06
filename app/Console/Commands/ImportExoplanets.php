<?php

namespace App\Console\Commands;

use App\Models\Enums\ExoplanetType;
use App\Models\Enums\StarType;
use App\Models\Exoplanet;
use App\Models\Publication;
use App\Models\Star;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportExoplanets extends Command
{
    protected $signature = 'import:exoplanets {--file=} {--fresh}';

    protected $description = 'Import exoplanets from file';

    public function handle(): void
    {

        $exoplanets = $this->getFileContent();
        if (empty($exoplanets)) {
            return;
        }
        if ($this->option('fresh')) {
            DB::table('exoplanets')->delete();
            DB::table('stars')->delete();
        }
        $starsByNames = $this->importStars($exoplanets);
        $this->importExoplanets($exoplanets, $starsByNames);

    }

    private function importStars(array $exoplanets): array
    {
        $result = [];
        foreach ($exoplanets as $exoplanet) {
            if (! empty($result[$exoplanet['star_name']])) {
                $this->info('Star ' . $exoplanet['star_name'] . ' already imported');
                continue;
            }
            $star = Star::where('name', $exoplanet['star_name'])->first();
            if ($star) {
                $this->info('Star ' . $exoplanet['star_name'] . ' already imported');
                $result[$exoplanet['star_name']] = $star->id;
                continue;
            }
            $this->info('Importing stars ' . $exoplanet['name']);

            // Import exoplanet here
            $starData = [
                'name' => $exoplanet['star_name'],
                'type' => StarType::from($exoplanet['star_type']),
                'mass' => $this->parseFloat($exoplanet['star_mass']),
                'radius' => $this->parseFloat($exoplanet['star_radius']),
                'temperature' => $exoplanet['star_temperature'],
                'age' => $exoplanet['star_age'],
            ];
            $star = Star::create($starData);

            $result[$exoplanet['star_name']] = $star->id;
        }
        return $result;
    }

    private function importExoplanets(array $exoplanets, array $starsByNames): void
    {
        foreach ($exoplanets as $exoplanet) {
            $model = Exoplanet::where('name', $exoplanet['name'])->first();
            if ($model) {
                $this->info('Exoplanet ' . $exoplanet['name'] . ' already imported');
                continue;
            }
            $this->info('Importing exoplanet ' . $exoplanet['name']);
            $data = [
                'star_id' => $starsByNames[$exoplanet['star_name']],
                'name' => $exoplanet['name'],
                'type' => ExoplanetType::GAS_GIANT,
                'description' => $exoplanet['description'],
                'mass' => $this->parseFloat($exoplanet['mass']),
                'radius' => $this->parseFloat($exoplanet['radius']),
                'orbital_period' => $this->parseFloat($exoplanet['orbital_period']),
                'semi_major_axis' => $this->parseFloat($exoplanet['semi_major_axis']),
                'eccentricity' => $this->parseFloat($exoplanet['eccentricity']),
                'temperature' => $exoplanet['temperature'],
                'gravity' => $this->parseFloat($exoplanet['gravity'], 0),
                'density' => $this->parseFloat($exoplanet['density'], 0),
                'habitability' => $exoplanet['habitability'],
                'surface_conditions' => $exoplanet['surface_conditions'],
                'age' => $this->parseFloat($exoplanet['age']),
                'distance_from_earth' => $this->parseFloat($exoplanet['distance_from_earth']),
                'travel_time' => $this->parseFloat($exoplanet['travel_time']),
                'discovered_method' => $exoplanet['discovered_method'],
                'exoplanet_type' => $exoplanet['exoplanet_type'],
                'planet_texture' => $exoplanet['planet_texture'],
                'surface_photos' => $exoplanet['surface_photos'],
                'locals_portrait' => $exoplanet['locals_portrait'],
                'flora_photos' => $exoplanet['flora_photos'],
                'camp_photo' => $exoplanet['camp_photo'],
                'background' => $exoplanet['background'],
            ];
            $model = Exoplanet::create($data);

            $publications = $data['publications'] ?? [];
            foreach ($publications as $publication) {
                Publication::create([
                    'exoplanet_id' => $model->id,
                    'title' => $publication['title'] ?? '',
                    'link' => $publication['link'] ?? '',
                    'description' => $publication['description'] ?? '',
                ]);
            }
        }
    }

    private function parseFloat(?string $item, ?float $default = 0): ?float
    {
        if (! $item) {
            return $default;
        }
        $parts = explode(' ', $item);
        if (count($parts) < 1) {
            return $default;
        }
        return (float) $parts[0];
    }

    public function getFileContent(): array
    {
        return json_decode(file_get_contents($this->option('file')), true);
    }

}

<?php
/**
 * Description of IndexPlanetsApiController.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace App\Http\Controllers\Api\Exoplanets;


use App\Http\Resources\ExoplanetApiResource;
use App\Models\Exoplanet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class IndexExoplanetsApiController
{

    public function __invoke(Request $request): JsonResponse
    {
        $items = $this->searchItems($request);

        return response()->json([
            'items' => ExoplanetApiResource::collection($items),
            'total' => Exoplanet::query()->count(),
        ]);
    }

    private function searchItems(Request $request): Collection
    {
        $qb = Exoplanet::query()
            ->orderBy('name')
            ->take($request->get('limit', 50))
            ->skip($request->get('offset', 0));

        $q = $request->get('q');
        if ($q) {
            $qb->where('name', 'like', "$q%");
        }
        $qb->with([
            'star',
            'publications',
        ]);

        return $qb->get();
    }

}

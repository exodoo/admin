<?php
/**
 * Description of IndexPlanetsApiController.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace App\Http\Controllers\Api\Planets;


use App\Models\Planet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class IndexPlanetsApiController
{

    public function __invoke(Request $request): JsonResponse
    {
        $planets = $this->searchItems($request);

        return response()->json($planets);
    }

    private function searchItems(Request $request): Collection
    {
        $qb = Planet::query()
            ->orderBy('name')
            ->take($request->get('limit', 50))
            ->skip($request->get('offset', 0));

        $q = $request->get('q');
        if ($q) {
            $qb->where('name', 'like', "$q%");
        }

        return $qb->get();
    }

}

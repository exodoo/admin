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

class ShowExoplanetApiController
{

    public function __invoke(Request $request, Exoplanet $exoplanet): JsonResponse
    {
        return response()->json(
            new ExoplanetApiResource($exoplanet)
        );
    }
}

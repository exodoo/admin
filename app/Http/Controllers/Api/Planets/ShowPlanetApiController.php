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

class ShowPlanetApiController
{

    public function __invoke(Request $request, Planet $planet): JsonResponse
    {
        return response()->json([
            $planet,
        ]);
    }
}

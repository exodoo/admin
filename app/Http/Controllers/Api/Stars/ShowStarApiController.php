<?php
/**
 * Description of IndexPlanetsApiController.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace App\Http\Controllers\Api\Stars;


use App\Models\Star;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowStarApiController
{

    public function __invoke(Request $request, Star $star): JsonResponse
    {
        return response()->json([
            $star,
        ]);
    }
}

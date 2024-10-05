<?php
/**
 * Description of LikePlanetTinderApiController.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace App\Http\Controllers\Api\Games\Tinder\Gamers;


use App\Http\Controllers\Api\Games\Tinder\TinderApiController;
use App\Http\Resources\ExoplanetApiResource;
use App\Models\Exoplanet;
use App\Models\Gamer;
use Illuminate\Http\JsonResponse;

class IndexGamerExoplanetsTinderApiController extends TinderApiController
{

    public function __invoke(Gamer $gamer): JsonResponse
    {

        return response()->json([
            'items' => ExoplanetApiResource::collection($gamer->exoplanets),
            'total' => $gamer->exoplanets->count(),
        ]);
    }

}

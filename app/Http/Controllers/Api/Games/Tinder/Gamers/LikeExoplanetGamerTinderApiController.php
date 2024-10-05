<?php
/**
 * Description of LikePlanetTinderApiController.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace App\Http\Controllers\Api\Games\Tinder\Gamers;


use App\Http\Controllers\Api\Games\Tinder\TinderApiController;
use App\Models\Exoplanet;
use App\Models\Gamer;
use Illuminate\Http\JsonResponse;

class LikeExoplanetGamerTinderApiController extends TinderApiController
{

    public function __invoke(Gamer $gamer, Exoplanet $exoplanet): JsonResponse
    {
        $gamer->likeExoplanet($exoplanet);

        return $this->responseOk();
    }

}

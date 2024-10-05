<?php
/**
 * Description of LikePlanetTinderApiController.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace App\Http\Controllers\Api\Games\Tinder\Planets;


use App\Http\Controllers\Api\Games\Tinder\TinderApiController;
use App\Models\Gamer;
use App\Models\Exoplanet;
use Illuminate\Http\JsonResponse;

class LikeExoplanetTinderApiController extends TinderApiController
{

    public function __invoke(Exoplanet $exoplanet, Gamer $gamer): JsonResponse
    {
        $gamer->likeExoplanet($exoplanet);

        return $this->responseOk();
    }

}

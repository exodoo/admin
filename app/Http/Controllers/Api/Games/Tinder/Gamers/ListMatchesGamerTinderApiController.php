<?php
/**
 * Description of StoreGamerTinderApiController.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace App\Http\Controllers\Api\Games\Tinder\Gamers;


use App\Http\Controllers\Api\Games\Tinder\TinderApiController;
use App\Models\Gamer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListMatchesGamerTinderApiController extends TinderApiController
{

    public function __invoke(Gamer $gamer): JsonResponse
    {

    }

}

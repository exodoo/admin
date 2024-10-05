<?php
/**
 * Description of StoreGamerTinderApiController.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace App\Http\Controllers\Api\Games\Tinder\Gamers;


use App\Http\Controllers\Api\Games\Tinder\Gamers\Requests\StoreGamerRequest;
use App\Http\Controllers\Api\Games\Tinder\TinderApiController;
use App\Models\Gamer;
use Illuminate\Http\JsonResponse;

class StoreGamerTinderApiController extends TinderApiController
{

    public function __invoke(StoreGamerRequest $request): JsonResponse
    {
        $gamer = Gamer::create($request->validated());

        return response()->json($gamer);
    }

}

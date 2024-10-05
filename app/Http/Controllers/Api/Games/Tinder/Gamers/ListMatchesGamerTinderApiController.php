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
use Illuminate\Support\Facades\DB;

class ListMatchesGamerTinderApiController extends TinderApiController
{

    public function __invoke(Gamer $gamer): JsonResponse
    {
        $gamerId = $gamer->id;

        if ($gamer->exoplanets->isEmpty()) {
            return response()->json([
                'matches' => []
            ]);
        }

        // Find other gamers who liked the same exoplanets
        $matches = DB::table('exoplanet_gamer as eg1')
            ->join('exoplanet_gamer as eg2', 'eg1.exoplanet_id', '=', 'eg2.exoplanet_id')
            ->where('eg1.gamer_id', $gamerId)  // Target gamer's likes
            ->where('eg2.gamer_id', '!=', $gamerId) // Exclude the target gamer
            ->select('eg2.gamer_id', DB::raw('count(*) as shared_exoplanets'))
            ->groupBy('eg2.gamer_id')
            ->orderByDesc('shared_exoplanets')
            ->get();

        return response()->json([
            'matches' => $matches,
        ]);
    }

}

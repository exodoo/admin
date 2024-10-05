<?php

use App\Http\Controllers\Api\Games\Tinder\Gamers\ListMatchesGamerTinderApiController;
use App\Http\Controllers\Api\Games\Tinder\Gamers\StoreGamerTinderApiController;
use App\Http\Controllers\Api\Games\Tinder\Planets\LikeExoplanetTinderApiController;
use App\Http\Controllers\Api\Exoplanets\IndexExoplanetsApiController;
use App\Http\Controllers\Api\Exoplanets\ShowExoplanetApiController;
use App\Http\Controllers\Api\Stars\IndexStarsApiController;
use App\Http\Controllers\Api\Stars\ShowStarApiController;
use Illuminate\Support\Facades\Route;


Route::get('exoplanets', IndexExoplanetsApiController::class);
Route::get('exoplanets/{exoplanet}', ShowExoplanetApiController::class);

Route::get('stars', IndexStarsApiController::class);
Route::get('stars/{star}', ShowStarApiController::class);

Route::post('games/tinder/gamers', StoreGamerTinderApiController::class);
Route::post('games/tinder/gamers/{gamer}/matches', ListMatchesGamerTinderApiController::class);

Route::post('games/tinder/exoplanets/{exoplanet}/like', LikeExoplanetTinderApiController::class);

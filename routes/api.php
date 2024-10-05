<?php

use App\Http\Controllers\Api\Games\Tinder\Gamers\ListMatchesGamerTinderApiController;
use App\Http\Controllers\Api\Games\Tinder\Gamers\StoreGamerTinderApiController;
use App\Http\Controllers\Api\Games\Tinder\Planets\LikeExoplanetTinderApiController;
use App\Http\Controllers\Api\Exoplanets\IndexExoplanetsApiController;
use App\Http\Controllers\Api\Exoplanets\ShowExoplanetApiController;
use App\Http\Controllers\Api\Stars\IndexStarsApiController;
use App\Http\Controllers\Api\Stars\ShowStarApiController;
use Illuminate\Support\Facades\Route;


Route::get('exoplanets', IndexExoplanetsApiController::class)->name('api.exoplanets.index');
Route::get('exoplanets/{exoplanet}', ShowExoplanetApiController::class)->name('api.exoplanets.show');

Route::get('stars', IndexStarsApiController::class)->name('api.stars.index');
Route::get('stars/{star}', ShowStarApiController::class)->name('api.stars.show');

Route::post('games/tinder/gamers', StoreGamerTinderApiController::class)->name('api.games.tinder.gamers.store');
Route::get('games/tinder/gamers/{gamer}/matches', ListMatchesGamerTinderApiController::class)->name('api.games.tinder.gamers.matches');

Route::post('games/tinder/exoplanets/{exoplanet}/{gamer}/like', LikeExoplanetTinderApiController::class)->name('api.games.tinder.exoplanets.like');

<?php

use App\Http\Controllers\Api\Exoplanets\IndexExoplanetsApiController;
use App\Http\Controllers\Api\Exoplanets\ShowExoplanetApiController;
use App\Http\Controllers\Api\Games\Tinder\Gamers\IndexGamerExoplanetsTinderApiController;
use App\Http\Controllers\Api\Games\Tinder\Gamers\LikeExoplanetGamerTinderApiController;
use App\Http\Controllers\Api\Games\Tinder\Gamers\ListMatchesGamerTinderApiController;
use App\Http\Controllers\Api\Games\Tinder\Gamers\StoreGamerTinderApiController;
use App\Http\Controllers\Api\Stars\IndexStarsApiController;
use App\Http\Controllers\Api\Stars\ShowStarApiController;
use Illuminate\Support\Facades\Route;


Route::get('exoplanets', IndexExoplanetsApiController::class)->name('api.exoplanets.index');
Route::get('exoplanets/{exoplanet}', ShowExoplanetApiController::class)->name('api.exoplanets.show');

Route::get('stars', IndexStarsApiController::class)->name('api.stars.index');
Route::get('stars/{star}', ShowStarApiController::class)->name('api.stars.show');

Route::post('games/tinder/gamers', StoreGamerTinderApiController::class)->name('api.games.tinder.gamers.store');
Route::get('games/tinder/gamers/{gamer}/matches', ListMatchesGamerTinderApiController::class)->name('api.games.tinder.gamers.matches');
Route::get('games/tinder/gamers/{gamer}/exoplanets', IndexGamerExoplanetsTinderApiController::class)->name('api.games.tinder.gamers.exoplanets.index');
Route::post('games/tinder/gamers/{gamer}/exoplanets/{exoplanet}', LikeExoplanetGamerTinderApiController::class)->name('api.games.tinder.gamers.exoplanets.like');

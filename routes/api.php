<?php

use App\Http\Controllers\Api\Planets\IndexPlanetsApiController;
use App\Http\Controllers\Api\Planets\ShowPlanetApiController;
use App\Http\Controllers\Api\Stars\IndexStarsApiController;
use App\Http\Controllers\Api\Stars\ShowStarApiController;
use Illuminate\Support\Facades\Route;


Route::get('planets', IndexPlanetsApiController::class);
Route::get('planets/{planet}', ShowPlanetApiController::class);

Route::get('stars', IndexStarsApiController::class);
Route::get('stars/{star}', ShowStarApiController::class);

<?php

use App\Http\Controllers\RaceController;
use Illuminate\Support\Facades\Route;

Route::get('save-results/{sessionKey}', [RaceController::class, 'saveResults']);
Route::get('get-results', [RaceController::class, 'getGroupedData']);

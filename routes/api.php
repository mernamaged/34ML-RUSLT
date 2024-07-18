<?php

use App\Http\Controllers\Api\AchievementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('users/{user}/achievements', [AchievementController::class, 'index']);

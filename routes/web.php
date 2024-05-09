<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlogController::class, 'index']);
Route::get('tag/{tag}', [BlogController::class, 'tag']);
Route::get('page/{slug}', [PagesController::class, 'page']);
Route::get('{slug}', [BlogController::class, 'show']);

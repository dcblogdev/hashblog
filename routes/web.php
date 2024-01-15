<?php


use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlogController::class, 'index']);
Route::get('tag/{tag}', [BlogController::class, 'tag']);
Route::get('{slug}', [BlogController::class, 'show']);

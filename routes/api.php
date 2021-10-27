<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TagController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/notes',[NoteController::class,'getAllNotes']);
Route::post('/add/notes',[NoteController::class,'addNotes']);

Route::get('/tags',[TagController::class,'getAllTags']);
Route::post('/add/tag',[TagController::class,'addTag']);
Route::delete('/delete/tag/{id}',[TagController::class,'deleteTag']);
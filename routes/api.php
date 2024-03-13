<?php

use App\Http\Controllers\categoriesController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\etatController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\prioriteController;
use App\Http\Controllers\projetsController;
use App\Http\Controllers\ticketsController;
use App\Http\Controllers\userController;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('tickets',ticketsController::class)
->missing(function (Request $request) {
    return Redirect::route('tickets.index');
});
// projets
Route::apiResource('projets',projetsController::class);
// categories
Route::apiResource('categories',categoriesController::class);
// etats
Route::apiResource('etats',etatController::class);
//priorites
Route::apiResource('priorites',prioriteController::class);
//users
Route::apiResource('users',userController::class);
//Client
Route::apiResource('clients',clientController::class);
//ticket
Route::apiResource('tickets',ticketsController::class);
//commentaire
Route::apiResource('commentaires',CommentaireController::class);
//historique
Route::apiResource('historiques',HistoriqueController::class);

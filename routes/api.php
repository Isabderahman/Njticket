<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\EtatController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\PrioriteController;
use App\Http\Controllers\ProjetsController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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
//LOGIN AND LOGOUT
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

// projets
Route::apiResource('projets',ProjetsController::class);
/*
// GET : api/projets
// GET : api/projets/{id_Projet}
// POST : body-param :'nom_projet'=>["required"] api/projets
// PUT : body-param :'nom_projet'=>["required"] api/projets/{id_Projet}
// PATCH :  body-param :'nom_projet'=>["sometimes|required"] api/projets/{id_Projet}
// DELETE : api/projets/{id_Projet}
*/
// categories
Route::apiResource('categories',CategoriesController::class);
/*
// GET : api/categories
// GET : api/categories/{id_categorie}
// POST : body-param :'type_categorie'=>["required"] api/categories
// PUT : body-param :'type_categorie'=>["required"] api/categories/{id_categorie}
// PATCH :  body-param :'type_categorie'=>["sometimes|required"] api/categories/{id_categorie}
// DELETE : api/categories/{id_categorie}
*/

// etats
Route::apiResource('etats',EtatController::class);
/*
// GET : api/etats
// GET : api/etats/{id_etat}
// POST : body-param :'type_etat'=>["required"]  api/etats
// PUT : body-param :'type_etat'=>["required"] api/etats/{id_etat}
// PATCH :  body-param :'type_etat'=>["sometimes|required"] api/etats/{id_etat}
// DELETE : api/etats/{id_etat}
*/


//priorites
Route::apiResource('priorites',PrioriteController::class);
/*
// GET : api/priorites
// GET : api/priorites/{id_priorite}
// POST : body-param :'type_priorite'=>["required"] api/priorites
// PUT : body-param :'type_priorite'=>["required"] api/priorites/{id_priorite}
// PATCH :  body-param :'type_priorite'=>["sometimes|required"] api/priorites/{id_priorite}
// DELETE : api/priorites/{id_priorite}
*/

//users
Route::apiResource('users',UserController::class);
/*
// GET : api/users
// GET : api/users/{id_user}
// POST : body-param :[
            "nom" => 'required|max:16',
            "prenom" => 'required|max:16',
            "email" => 'required|email',
            "password" => 'required|min:8',
        ]; 
        api/users

// PUT : body-param :'body-param :[
            "nom" => 'required|max:16',
            "prenom" => 'required|max:16',
            "email" => 'required|email',
            "password" => 'required|min:8',
        ]; 
        api/users/{id_user}
// PATCH :  body-param :body-param :[
            "nom" => 'sometimes|required|max:16',
            "prenom" => 'sometimes|required|max:16',
            "email" => 'sometimes|required|email',
            "password" => 'sometimes|required|min:8',
        ]; 
        api/users
// DELETE : api/users/{id_user}
*/

//Client
Route::apiResource('clients',ClientController::class);
/*
// GET : api/clients
// GET : api/clients/{id_user}
// POST : body-param :[
            "profile" => 'required',
            "entreprise" => 'required',
            "projet_id" => 'required',

            "nom" => 'required|max:16',
            "prenom" => 'required|max:16',
            "email" => 'required|email',
            "password" => 'required|min:8',
        ]; 
        api/users

// PUT : body-param :'body-param :[
                "Profile" => 'required',
                "entreprise" => 'required',
                "Projet_id" => 'required',
            ]; 
        api/clients/{id_client}
// PATCH :  [
                "Profile" => 'sometimes|required',
                "entreprise" => 'sometimes|required',
                "Projet_id" => 'sometimes|required',
            ]; 
        api/clients/{id_client}
// DELETE : api/clients/{id_client}
*/
//ticket
Route::apiResource('tickets',TicketsController::class);
/*
// GET : api/tickets
// GET : api/tickets/{id_tickets}
// POST : body-param :[
            'titre_ticket' => 'required',
            'contenu' => 'required',
            'projet_id' => 'required',
            'categorie_id' => 'required',
            'priorite_id' => 'required',
            'etat_id' => 'required',
            'type_ticket' => 'required',
            'realisateur_id' => 'required',
        ]; api/tickets
// PUT : body-param :[
                'titre_ticket'=>'required',
                'contenu'=>'required',
                'projet_id'=>'required',
                'categorie_id'=>'required',
                'priorite_id'=>'required',
                'etat_id'=>'required',
                'type_ticket'=>'required',
                'description_modification'=>'required'
            ]; api/tickets/{id_tickets}
// PATCH :  body-param : [
                'titre_ticket'=>'sometimes|required',
                'contenu'=>'sometimes|required',
                'projet_id'=>'sometimes|required',
                'type_ticket'=>'sometimes|required',
                'categorie_id'=>'sometimes|required',
                'priorite_id'=>'sometimes|required',
                'etat_id'=>'sometimes|required',
                'description_modification'=>'required'
            ]; api/tickets/{id_tickets}
// DELETE : api/tickets/{id_tickets}
*/

//commentaire
Route::apiResource('commentaires',CommentaireController::class);
/*
// GET : api/commentaires
// GET : api/commentaires/{id_commentaires}
// POST : body-param :'[
            'contenu'=>'required',
            'commentateur_id'=>'required',
            'ticket_id'=>'required',
        ] api/commentaires
// PUT : body-param :[
            'contenu'=>'required',
            'commentateur_id'=>'required',
            'ticket_id'=>'required',
        ] api/commentaires/{id_commentaires}
// PATCH :  body-param :[
                'contenu'=>'sometimes|required',
                'commentateur_id'=>'sometimes|required',
                'ticket_id'=>'sometimes|required',
            ]api/commentaires/{id_commentaires}
// DELETE : api/commentaires/{id_commentaires}
*/

//historique
Route::apiResource('historiques',HistoriqueController::class);
/*
// GET : api/historiques/{id_ticket}
*/

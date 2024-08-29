<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;



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

// routes/api.php


Route::get('v1/users', function () {
    $users = User::all();
    return response()->json([
        'status' => 'success',
        'data' => $users,
        'message' => 'All users retrieved successfully'
    ], 200);
});

Route::get('v1/users/{id}', function ($id) {
    $user = User::find($id);

    if ($user) {
        return response()->json([
            'status' => 'success',
            'data' => $user,
            'message' => 'User retrieved successfully'
        ], 200);
    } else {
        return response()->json([
            'status' => 'error',
            'data' => null,
            'message' => 'User not trouver'
        ], 404);
    }
});


// Définir le préfixe pour les routes utilisateurs
Route::prefix('v1/users')->name('users.')->middleware('auth:sanctum')->group(function () {
    // Route pour enregistrer un utilisateur
    Route::post('/', [UserController::class, 'store'])->name('store');

    // Route pour afficher un utilisateur spécifique
    Route::get('{id}', [UserController::class, 'show'])->name('show');

    // Route pour modifier un utilisateur
    Route::put('{id}', [UserController::class, 'update'])->name('update');
    Route::patch('{id}', [UserController::class, 'update'])->name('update');

    // Route pour supprimer un utilisateur
    Route::delete('{id}', [UserController::class, 'destroy'])->name('destroy');

});

Route::prefix('v1')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
});


// route pour les clients
Route::prefix('v1/clients')->name('clients.')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('index');
    Route::get('{id}', [ClientController::class, 'show'])->name('show');
    Route::post('/', [ClientController::class, 'store'])->name('store');
    Route::put('{id}', [ClientController::class, 'update'])->name('update');
    Route::delete('{id}', [ClientController::class, 'destroy'])->name('destroy');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

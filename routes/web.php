<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\AssujettiController;
use App\Http\Controllers\MouvementController;
use App\Http\Controllers\SituationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Broadcast::routes();
    Route::get('/', 'App\Http\Controllers\AssujettiController@accueil')->name('accueil');
    Route::resource('/assujettis', AssujettiController::class);
    Route::resource('/mouvements', MouvementController::class);
    Route::post('/assujettis/fields', [AssujettiController::class, 'fields'])->name('assujettis.fields');
    Route::get('/situations', [SituationController::class, 'index'])->name('situations.index');
    Route::get('/situations/globale', [SituationController::class, 'globale'])->name('situations.globale');
    Route::get('/situations/journaliere', [SituationController::class, 'journaliere'])->name('situations.journaliere');
    Route::get('/situations/coupons', [SituationController::class, 'coupons'])->name('situations.coupons');
    Route::get('/situations/moyen_transports', [SituationController::class, 'moyen_transports'])->name('situations.moyen_transports');
    Route::get('/graphe-selection', [SituationController::class, 'graphe_selection'])->name('graphs.selection');
    Route::get('/graphe-formation', [SituationController::class, 'graphe_formation'])->name('graphs.formation');
    Route::get('/pw-edit', [AuthenticatedSessionController::class, 'edit'])->name('password.edit');
    Route::put('/pw-update', [AuthenticatedSessionController::class, 'update'])->name('update.password');
    Route::get('/get-tarif', [TarifController::class, 'getTarif'])->name('get-tarif');
    Route::get('/situation-generale', [SituationController::class, 'situationGenerale'])->name('situation.generale');

    Route::get('/test-broadcast', function () {
        event(new \App\Events\AssujettiEvent('Test notification temps réel !', 'admis', 'success', 'inc', 'centre-test'));
        return 'Event broadcasté !';
    })->name('test.broadcast');

});
require __DIR__.'/auth.php';

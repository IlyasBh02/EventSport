<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('events.index'));

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Événements — liste (tous)
    Route::get('/events', [EventController::class, 'index'])->name('events.index');

    // Événements — CRUD (admin + organisateur) — create AVANT {event}
    Route::middleware('role:admin,organisateur')->group(function () {
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');

        // Matchs
        Route::get('/events/{event}/matchs/create', [MatchController::class, 'create'])->name('matchs.create');
        Route::post('/events/{event}/matchs', [MatchController::class, 'store'])->name('matchs.store');
        Route::get('/events/{event}/matchs/{match}/edit', [MatchController::class, 'edit'])->name('matchs.edit');
        Route::put('/events/{event}/matchs/{match}', [MatchController::class, 'update'])->name('matchs.update');
        Route::get('/events/{event}/matchs/{match}/score', [MatchController::class, 'score'])->name('matchs.score');
        Route::post('/events/{event}/matchs/{match}/score', [MatchController::class, 'saveScore'])->name('matchs.saveScore');
    });

    // Événement — show (tous) — APRÈS /events/create pour éviter conflit
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

    // Suppression (admin seulement)
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy')->middleware('role:admin');

    // Inscriptions
    Route::post('/events/{event}/inscrire', [InscriptionController::class, 'store'])->name('inscriptions.store');
    Route::delete('/inscriptions/{inscription}', [InscriptionController::class, 'destroy'])->name('inscriptions.destroy');
    Route::get('/mes-inscriptions', [InscriptionController::class, 'mesInscriptions'])->name('inscriptions.index');

    // Favoris
    Route::get('/favoris', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/events/{event}/favoris', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/events/{event}/favoris', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    // Admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('role:admin');
});

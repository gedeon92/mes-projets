<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\EtudiantProfileController; 
use Illuminate\Support\Facades\Route;

// Routes d'authentification
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Route racine
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('welcome');
    }
    return redirect()->route('login');
});

// Page form
Route::get('/form', function () {
    return view('form');
})->middleware(['auth', 'admin'])->name('form');

// Page d'accueil après connexion
Route::get('/welcome', function () {
    return view('welcome');
})->middleware(['auth'])->name('welcome');

// Redirection après authentification
Route::get('/home', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->role === 'student') {
        return redirect()->route('vote.student');
    }
    return abort(403);
})->middleware(['auth'])->name('home');

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/notifications', [ProfileController::class, 'updateNotifications'])->name('profile.notifications');
});

// Routes pour les administrateurs
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.profile');
    })->name('admin.dashboard');

    Route::get('/admin/menu', function () {
        return view('form');
    })->name('admin.menu');

    // Profil administrateur
    Route::get('/admin/profile', [ProfileController::class, 'editAdmin'])->name('admin.profile');
    Route::patch('/admin/profile', [ProfileController::class, 'updateAdmin'])->name('admin.profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroyAdmin'])->name('admin.profile.destroy');

    // Routes pour la gestion des étudiants
    Route::resource('etudiants', EtudiantController::class);
    Route::resource('candidats', CandidatController::class);
    Route::resource('departements', DepartementController::class);
    Route::resource('filieres', FiliereController::class);
    Route::get('/votes/results', [VoteController::class, 'results'])->name('votes.results');
});

// Routes pour les étudiants
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/etudiant/dashboard', function () {
        return view('etudiant.dashboard');
    })->name('etudiant.dashboard');
    
    Route::get('/etudiant/profile', [EtudiantProfileController::class, 'show'])->name('etudiant.profile');
    Route::patch('/etudiant/profile', [EtudiantProfileController::class, 'update'])->name('etudiant.profile.update');
    
    Route::get('/vote', [VoteController::class, 'studentVote'])->name('vote.student');
    Route::post('/vote', [VoteController::class, 'submitVote'])->name('vote.submit');
});

require __DIR__.'/auth.php';

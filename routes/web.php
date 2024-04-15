<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\MaestrosController;

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
// Route::name("users.")->prefix('/users')->group(function () {
//     Route::get('/', [UserController::class, 'index'])->name('index');
//     Route::get('/create', [UserController::class, 'create'])->name('create');
//     Route::get('/{id}', [UserController::class, 'show'])->where('id', '[0-9]+')->name('show');
//     Route::get('/{id}/edit', [UserController::class, 'edit'])->where('id', '[0-9]+')->name('edit');
// });

//Index de todos
Route::get('/carreras/vercarreras', [CarreraController::class, 'index'])->name('carreras.vercarreras');
Route::get('/materias/vermaterias', [MateriaController::class, 'index'])->name('materias.vermaterias');
Route::get('/alumnos/veralumnos', [AlumnosController::class, 'index'])->name('alumnos.veralumnos');
Route::get('/maestros/vermaestros', [MaestrosController::class, 'index'])->name('maestros.vermaestros');



//Carreras
Route::post('/carreras/create', [CarreraController::class, 'store'])->name('carreras.store');
Route::get('/carreras/create', [CarreraController::class, 'create'])->name('carreras.create');
Route::delete('/carreras/{id}', [CarreraController::class, 'destroy'])->where('id', '[0-9]+')->name('carreras.destroy');
Route::get('/carreras/{id}/edit', [CarreraController::class, 'edit'])->where('id', '[0-9]+')->name('carreras.edit');
Route::put('/carreras/{id}/edit', [CarreraController::class, 'update'])->where('id', '[0-9]+')->name('carreras.update');

//Maestrosssss
Route::get('/maestros/create', [MaestrosController::class, 'create'])->name('maestros.create');
Route::post('/maestros/create', [MaestrosController::class, 'store'])->name('maestros.store');
Route::delete('/maestros/{id}', [MaestrosController::class, 'destroy'])->where('id', '[0-9]+')->name('maestros.destroy');
Route::get('/maestros/{id}/edit', [MaestrosController::class, 'edit'])->where('id', '[0-9]+')->name('maestros.edit');
Route::put('/maestros/{id}/edit', [MaestrosController::class, 'update'])->where('id', '[0-9]+')->name('maestros.update');


//Materias
Route::get('/materias/create', [MateriaController::class, 'create'])->name('materias.create');
Route::post('/materias/create', [MateriaController::class, 'store'])->name('materias.store');
Route::delete('/materias/{id}', [MateriaController::class, 'destroy'])->where('id', '[0-9]+')->name('materias.destroy');
Route::get('/materias/{id}/edit', [MateriaController::class, 'edit'])->where('id', '[0-9]+')->name('materias.edit');
Route::put('/materias/{id}/edit', [MateriaController::class, 'update'])->where('id', '[0-9]+')->name('materias.update');


//Alumnos
Route::get('/alumnos/create', [AlumnosController::class, 'create'])->name('alumnos.create');
Route::post('/alumnos/create', [AlumnosController::class, 'store'])->name('alumnos.store');
Route::delete('/alumnos/{id}', [AlumnosController::class, 'destroy'])->where('id', '[0-9]+')->name('alumnos.destroy');
Route::get('/alumnos/{id}/edit', [AlumnosController::class, 'edit'])->where('id', '[0-9]+')->name('alumnos.edit');
Route::put('/alumnos/{id}/edit', [AlumnosController::class, 'update'])->where('id', '[0-9]+')->name('alumnos.update');


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

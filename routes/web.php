<?php

use App\Http\Livewire\EstudianteController;
use App\Http\Livewire\MateriaController;
use App\Http\Livewire\NotasController;
use App\Http\Livewire\ProfesorController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/estudiante', EstudianteController::class)->name('estudiante.index');
Route::delete('/estudiantes/{id}', [EstudianteController::class, 'Destroy'])->name('estudiantes.destroy');

Route::get('/profesor', ProfesorController::class)->name('profesor.index');
Route::delete('/profe/{id}', [ProfesorController::class, 'Destroy'])->name('profe.destroy');


Route::get('/materia', MateriaController::class)->name('materia.index');
Route::delete('/mate/{id}', [MateriaController::class, 'Destroy'])->name('materia.destroy');

Route::get('/nota', NotasController::class)->name('nota.index');
Route::delete('/not/{id}', [NotasController::class, 'Destroy'])->name('nota.destroy');

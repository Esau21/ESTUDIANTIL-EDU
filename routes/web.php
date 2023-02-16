<?php

use App\Http\Livewire\EstudianteController;
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

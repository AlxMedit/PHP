<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CentrosController;

Route::get('/', [IndexController::class, 'index'])->name('centros.index');

Route::get('/centros/{id}/edit', [CentrosController::class, 'edit'])->name('centros.edit');
Route::put('/centros/{id}', [CentrosController::class, 'update'])->name('centros.update');

Route::delete('/centros/{id}', [CentrosController::class, 'destroy'])->name('centros.destroy');

Route::get('/centros/anadir', [CentrosController::class, 'showCreateForm'])->name('centros.createForm');
Route::post('/centros', [CentrosController::class, 'create'])->name('centros.create');
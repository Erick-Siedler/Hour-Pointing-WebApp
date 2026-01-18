<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\ApontamentoController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tarefa', [TarefaController::class, 'index'])->name('tarefa');
Route::post('/tarefa', [TarefaController::class, 'add'])->name('tarefa-adicionar');
Route::delete('/tarefa/{task}', [TarefaController::class, 'delete'])->name('tarefa-deletar');
Route::get('/tarefa/{task}/edit', [TarefaController::class, 'indexEdit'])->name('tarefa-form');
Route::put('/tarefa/{task}/edit', [TarefaController::class, 'edit'])->name('tarefa-editar');
Route::get('/tarefas/export', [TarefaController::class, 'exportTodas'])
->name('tarefas-export');
Route::get('/tarefas/brenda', [TarefaController::class, 'exportBrenda'])
->name('brenda-export');

Route::get('/tarefa/apontamento/{task}', [ApontamentoController::class, 'index'])->name('apontamentos');
Route::post('/tarefa/apontamento/{task}', [ApontamentoController::class, 'add'])->name('apontamento-adicionar');


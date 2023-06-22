<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\VendasController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/produtos', [ProdutosController::class, 'index']);
Route::get('/produtos/{id}', [ProdutosController::class, 'show']);
Route::post('/vendas', [VendasController::class, 'store']);


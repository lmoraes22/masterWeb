<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProdutosResource;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produto::get();
        return ProdutosResource::collection($produtos);
    }

    public function show(Produto $produto)
    {
        return new ProdutosResource($produto);
    }

}

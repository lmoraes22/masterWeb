<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    public function store(Request $request)
    {
        $venda = new Venda();
        $venda->user_id = 1;
        $venda->total = $request->total;
        $venda->save();

        foreach ($request->carrinho as $cart) {
            $venda->produtos()->attach($venda->user_id, [
                'quantidade' => $cart['quantidade'],
                'preco' => $cart['preco'],
                'status' => 1,
            ]);
        }

        return response()->json([
            'message' => 'Venda efetuada com sucesso!',
            'status' => 200
        ]);
    }
}

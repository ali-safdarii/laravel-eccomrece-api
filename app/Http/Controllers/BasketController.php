<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{


    public function index(Request $request)
    {


    }

    public function store(Request $request)
    {


        $data = Basket::updateOrCreate(
            ['products_id' => $request->products_id, 'quantity' => $request->quantity],
            ['user_id' => $request->user_id]
        );


        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Successfully Inserted'
            ]);
        }

    }


    public function selectCartItemById($id)
    {


        $products = DB::table('baskets')
            ->join('products', 'baskets.products_id', '=',
                'products.id')
            ->where('baskets.user_id', $id)
            ->select('products.*')
            ->get();

        $count = Basket::where('user_id', $id)->count();

        return response()->json([
            'cart_items' => $products,
            'count' => $count
        ], 200);


    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class BasketController extends Controller
{


    public function store(Request $request)
    {


        $data = Basket::updateOrCreate(
            ['products_id' => $request->products_id,
                'quantity' => $request->quantity],
            ['email' => $request->email]
        );


        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Successfully Inserted'
            ], 201);
        }


    }


    public function selectCartItemByEmail(Request $request)
    {
        $email = ['email' => $request->email];



                /*
            SELECT users.*,products.*
                    FROM baskets
                        JOIN users ON baskets.email = users.email
                            join products on baskets.products_id =products.id
                                where baskets.email ='ali@gmail.com'
*/


        $basket = DB::table("baskets")
            ->join("users", function ($join) {
                $join->on("baskets.email", "=", "users.email");
            })
            ->join("products", function ($join) {
                $join->on("baskets.products_id", "=", "products.id");
            })
            ->select("users.*", "products.*")
            ->where("baskets.email", "=", $email)
            ->get();


        return response()->json([
            'cart_items' => $basket,
        ], 200);


    }
}

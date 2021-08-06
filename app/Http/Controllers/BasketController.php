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


        $data = [
            'products_id' => $request->products_id,
            'email' => $request->email,
            'quantity' =>$request->quantity

        ];



        $Basket_exist = Basket::select('*')
            ->where('products_id',$request->products_id)
            ->first();

        if($Basket_exist == null)//if doesn't exist: create
        {
            Basket::create($request->all());

            return response()->json(['message'=> 'Successfully Adding To Cart'],200);
        }
        else //if exist: update
        {

            // you already retrieved the record and it exists, so just update it.
            $Basket_exist->update($request->all());

            return response()->json(['message'=> 'Successfully Updating To Cart'
            ,'data'=>$Basket_exist
            ],200);
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
                        where baskets.email ='ali@gmail.com' -> user Email
*/


        $basket = DB::table("baskets")
            ->join("users", function ($join) {
                $join->on("baskets.email", "=", "users.email");
            })
            ->join("products", function ($join) {
                $join->on("baskets.products_id", "=", "products.id");
            })
            ->select("users.email", "products.*","baskets.quantity")
            ->where("baskets.email", "=", $email)
            ->get();


        return response()->json([
            'cart_items' => $basket,
        ], 200);


    }
}

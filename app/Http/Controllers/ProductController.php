<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


//php artisan serve --host=192.168.1.10 --port=8000
class ProductController extends Controller
{
    public function index()
    {

        $data = Product::all();
        return response()->json([
            'data' => $data,

        ]);

/* error format
            return response()->json([
                'message' => "********",
                'code' => 409
            ],400);*/

    }


    public function findById()
    {

        /*
                return response()->json([
                    'data'=>$data
                ]);*/
    }


}

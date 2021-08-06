<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//php artisan passport:client --personal

//php artisan serve --host=192.168.1.8 --port=8000
//php artisan serve --host=192.168.1.12 --port=8000
class ProductController extends Controller
{
    public function index(Request $request)
    {

        //Normal Format
        /*        $data = Product::all();
                return response()->json([
                    'data' => $data,

                ]);*/


        // pagination format
        $per_page = (int)$request->input('per_page') ?: 10;
        $data = Product::paginate($per_page);
        $data->appends(['per_page' => $per_page]);
        return response()->json(
            $data,
        );


        /* error format
                    return response()->json([
                        'message' => "********",
                        'code' => 409
                    ],400);*/

    }


    public function normalWay()
    {

        //Normal Format
        $data = Product::all();
        return response()->json(
             $data,

        );
    }

}

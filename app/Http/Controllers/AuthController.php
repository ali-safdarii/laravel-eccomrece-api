<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use function React\Promise\all;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',

        ]);

        if($validator->fails()){
            return response()->json([$validator->errors()]);
        }

        $emailExist = User::where('email', $request->email)->first();

        if ($emailExist == null) {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $token = $user->createToken('LaravelAuthApp')->accessToken;

            return response()->json([
                'token' => $token,
                'email' => $user->email,
                'id' => $user->id,
                'message' => 'Registration Complete'
            ], 200);

        } else {
            return response()->json([
                'error' => 'Duplicate entry'
            ], 409);
        }


    }

    public function login(Request $request)
    {

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            $id = auth()->user()->id;
            $email = auth()->user()->email;
            return response()->json(['token' => $token, 'id' => $id,
                'email' => $email, 'status' => true], 200);
        } else {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    }


}

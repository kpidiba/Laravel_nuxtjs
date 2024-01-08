<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        //NOTE: VALIDATOR
        $data = $request->all();

        // NOTE: Creation de l' utilisateur
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        // NOTE: Reponse JSON
        $response = [
            'success' => true,
            'data' => $data,
            'token' => $user->createToken('CLE_SECRETE')->plainTextToken,
            'message' => 'user create'
        ];
        return response($response, Response::HTTP_OK);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            $user = Auth::user();
            $response = [
                'success' => true,
                'data' =>  new AuthResource(auth()->user()),
                'token' => $user->createToken('CLE_SECRETE')->plainTextToken,
                'message' => 'User Authentification success'
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Authentification Failed'
            ];
            return response($response, Response::HTTP_BAD_REQUEST);
        }
    }

    public function deconnexion(): Response
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response(['message' => "Deconnexion"], Response::HTTP_OK);
    }
}

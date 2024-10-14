<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Resources\Admin\UserResource;


class LoginController extends Controller
{
    public function store(LoginRequest $request)
    {
        $credentials = $request->loginUser();

        return response()->json([
            'token' => $credentials['token'],
            'user' => UserResource::make($credentials['user']),
        ]);
    }
}

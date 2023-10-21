<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Athenticatoion management class
 */
class AuthController extends Controller
{

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param boolean $is_admin
     * @return Response
     */
    public function login(Request $request): Response
    {
        $token = $request->user()->createToken('app');
        $response = [
            'message' => __('msg.auth.login'),
            'token' => $token->plainTextToken,
            'expires_in_minutes' => config('sanctum.expiration'),
            'user' => request()->user()
        ];

        return response($response);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response(["message" => __("msg.auth.logout")]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function fullLogout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response(["message" => __("msg.auth.logout")]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return Response
     */
    public function refresh(Request $request)
    {
        $token = $request->user()->createToken('app');
        $response = [
            'message' => __('msg.auth.refresh'),
            'token' => $token->plainTextToken,
            'expires_in_minutes' => config('sanctum.expiration'),
            'user' => request()->user()
        ];

        return response($response);
    }
}

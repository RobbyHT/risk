<?php

namespace App\Http\Controllers\app;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserMember;

class AppController extends Controller
{
    public function login(Request $request)
    {
        $creds = $request->only(['account', 'password']);

        if (!$token = auth()->attempt($creds)) {
            return response()->json(['error' => "account or password incorrect."], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }

    public function verify(Request $request)
    {
        $user = Auth()->guard('app')->user();

        if (!$user) {
            return response()->json(['error' => "You haven't logged in yet."], 401);
        }

        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'account' => $user->account,
            'email' => $user->email,
            'role' => $user->role,
        ];

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function logout(Request $request)
    {
        auth()->logout();

        return response()->json(['success' => true, 'message' => "您已成功登出"]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getProfile(Request $request)
    {
        $user = User::where('id', $request->user()->id)->firstOrFail();

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'role' => $user->role,
            'position' => $user->position,
            'department' => $user->department,
        ]);
    }
}


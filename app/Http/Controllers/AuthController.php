<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $login = Login::where('username', $request->username)->first();

        if ($login && password_verify($request->password, $login->password)) {
            return response()->json(['message' => 'Login successful', 'role' => $login->role], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function api_token(Request $request)
    {
        $token = Str::random(60);

        $request->user()->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();
        
        $data['api_token'] = $token;
        $data['response'] = 1;
        return response()->json($data);
    }
}

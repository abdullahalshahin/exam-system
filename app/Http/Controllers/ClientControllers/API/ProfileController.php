<?php

namespace App\Http\Controllers\ClientControllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function my_profile(Request $request) {
        $client = $request->user();

        return response([
            'success' => true,
            'message' => "Show",
            'result'  => $client
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersApi extends Controller
{
    

    public function getUser($username)
    {
        $url = env('API_URL').'user/'.$username;

        $response = Http::get($url, [
            'username' => $username
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json([
                'error' => 'Failed to fetch data from API'
            ], 500);
        }
    }

}

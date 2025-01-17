<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PetsApi extends Controller
{
    public function getPetsByStatus(Request $request)
    {
        $url = env('API_URL').'pet/findByStatus';

        $response = Http::get($url, [
            'status' => $request
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json([
                'error' => 'Failed to fetch data from API'
            ], 500);
        }
    }
    public function getPetsById(Request $request)
{
    $id = $request->query('petId');
    
    $url = env('API_URL').'pet/'.$id;

    $response = Http::get($url, [
        'id' => $id
    ]);

    if ($response->successful()) {
        // Przekazanie danych do widoku
        return view('pet.petsById', ['pet' => $response->json()]);
    } else {
        return view('pet.petsById', ['error' => 'Pet not found, Id doesn\'t exist']);
    }
}
}

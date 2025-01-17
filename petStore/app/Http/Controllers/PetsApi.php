<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PetsApi extends Controller
{
    public function getPetsByStatus(Request $request)
    {
        $status = $request->query('status');

        $url = env('API_URL').'pet/findByStatus';

        $response = Http::get($url, [
            'status' => $status
        ]);

        if ($response->successful()) {
            $pets = $response->json();

            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 10;
            $currentItems = array_slice($pets, ($currentPage - 1) * $perPage, $perPage);
            $paginatedPets = new LengthAwarePaginator($currentItems, count($pets), $perPage, $currentPage, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => $request->query(),
            ]);

            return view('pet.petsByStatus', ['pets' => $paginatedPets]);
        } else {
            return view('pet.petsByStatus', ['error' => 'Pet with this status not exist']);
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
            return view('pet.petsById', ['pet' => $response->json()]);
        } else {
            return view('pet.petsById', ['error' => 'Pet not found, Id doesn\'t exist']);
        }
    }
}

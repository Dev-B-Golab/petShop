<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


class PetsApi extends Controller
{
    public function petMainView(){
        return view('pet.petsMenu');
    }
    
    public function getPetsByStatus(Request $request)
    //WORKS
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
    //WORKS
    {
        $id = $request->query('petId');
        
        $url = env('API_URL').'pet/'.$id;

        $response = Http::get($url, [
            'id' => $id
        ]);

        if ($response->successful()) {
            return view('pet.petsById', ['pet' => $response->json()]);
        } else {
            return redirect()->back()->with('error', 'Pet with this Id not exist');
        }
    }

    public function addPet(Request $request)
    {
        $url = env('API_URL') . 'pet';
        $data = [
            'id' => 34567, //34567
            'category' => [
                'id' => 0, 
                'name' => $request->input('categoryName'),
            ],
            'name' => $request->input('name'),
            'photoUrls' => $request->input('photoUrls', []),
            'tags' => [
                [
                    'id' => 0,
                    'name' => $request->input('tagName'),
                ]
            ],
            'status' => $request->input('status', 'available')
        ];

        $response = Http::post($url, $data);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Pet added successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to add pet');
        }
    }

    public function updatePet(Request $request)
    //TODO id dla category i taga
    {
        $url = env('API_URL').'pet';

        $data = [
            'id' => $request->input('petId'), //34567
            'category' => [
                'id' => 0, 
                'name' => $request->input('categoryName'),
            ],
            'name' => $request->input('name'),
            'photoUrls' => $request->input('photoUrls', []),
            'tags' => [
                [
                    'id' => 0,
                    'name' => $request->input('tagName'),
                ]
            ],
            'status' => $request->input('status', 'available')
        ];


        $response = Http::put($url, $data);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Pet updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update pet');
        }
    }
    
    public function updatePetStatus(Request $request)
    {
        $petId = $request->input('petId');
        $name = $request->input('name');
        $status = $request->input('status');
        
        $url = env('API_URL') . 'pet/' . $petId;

        // Wysłanie żądania PUT (w zależności od wymagań API może to być POST, PATCH lub PUT)
        $response = Http::post($url, [
            'name' => $name,
            'status' => $status,
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Pet updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update pet');
        }
    }
    public function uploadImage(Request $request, $petId)
    {
        // Walidacja pliku
        $request->validate([
            'photoUrls' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'additionalMetadata' => 'nullable|string|max:255', 
        ]);

        if ($request->hasFile('photoUrls') && $request->file('photoUrls')->isValid()) {

            $file = $request->file('photoUrls');

            $filePath = $file->store('pet_images', 'public');

            $url = env('API_URL').$petId.'/uploadImage';

            $response = Http::attach('file', fopen(storage_path('app/public/' . $filePath), 'r'), 'file')
                            ->post($url, [
                                'additionalMetadata' => $request->input('additionalMetadata'),
                            ]);

            if ($response->successful()) {
                return redirect()->back()->with('success', 'Image updated successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to updated image');
            }
        }

        return redirect()->back()->with('error', 'No valid image file was uploaded');
    }
    public function deletePetById(Request $request)
    {
        $petId = $request->input('petId');
    
        $url = env('API_URL') . 'pet/' . $petId;
    
            $response = Http::delete($url);
    
            if ($response->successful()) {
                return redirect()->back()->with('success', 'Pet deleted successfully');
            } else {
                return redirect()->back()->with('error', 'Cannot delete pet: ' . $response->body());
            }
    }
}

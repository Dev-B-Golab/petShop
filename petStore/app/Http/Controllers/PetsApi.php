<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PetsApi extends Controller
{
    public function petMainView(){
        return view('pet.petsMenu');
    }
    
    public function getPetsByStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:available,pending,sold'
        ], [
            'status.required' => 'Status is required',
            'status.in' => 'Status must be one of: available, pending, sold'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid status  value'], 400);
        }

        $status = $request->input('status');
        
        $url = env('API_URL') . 'pet/findByStatus';
        
        $response = Http::get($url, [
            'status' => $status
        ]);
        
        if ($response->successful()) {
            return response()->json(['pet' => $response->json()], 200);
        }  else {
            return response()->json(['error' => 'An unexpected error occurred'], $response->status());
        }
    }

    public function getPetsById(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'petId' => 'required|numeric'
        ], [
            'petId.required' => 'Pet ID is required',
            'petId.numeric' => 'Pet ID must be a numeric value'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid ID supplied'], 400);
        }

        $id = $request->input('petId');
        
        $url = env('API_URL') . 'pet/' . $id;
        
        $response = Http::get($url);
        
        if ($response->successful()) {
            return response()->json(['pet' => $response->json()], 200);
        } elseif ($response->status() == 404) {
            return response()->json(['error' => 'Pet not found'], 404);
        } else {
            return response()->json(['error' => 'An unexpected error occurred'], $response->status());
        }
    }

    public function addPet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categoryName' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'photoUrls' => 'array',
            'photoUrls.*' => 'string|url|max:2048',
            'tagName' => 'required|string|max:255',
            'status' => 'required|in:available,pending,sold'
        ], [
            'categoryName.required' => 'Pet category name is required',
            'categoryName.string' => 'Pet category name must be a string value',
            'categoryName.max' => 'Pet category name must not exceed 255 characters',
            'name.required' => 'Pet name is required',
            'name.string' => 'Pet name must be a string value',
            'name.max' => 'Pet name must not exceed 255 characters',
            'photoUrls.array' => 'Photo URLs must be an array',
            'photoUrls.*.string' => 'Each photo URL must be a valid string',
            'photoUrls.*.url' => 'Each photo URL must be a valid URL',
            'photoUrls.*.max' => 'Each photo URL must not exceed 2048 characters',
            'tagName.required' => 'Tag name is required',
            'tagName.string' => 'Tag name must be a string value',
            'tagName.max' => 'Tag name must not exceed 255 characters',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be one of: available, pending, sold'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid input'], 405);
        }

        $url = env('API_URL') . 'pet';
        $data = [
            'id' => 34567,
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
            return response()->json(['error' => 'Error'], 500);
        }
    }

    public function updatePet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'petId' => 'required|numeric',
            'categoryName' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'photoUrls' => 'array',
            'tagName' => 'required|string|max:255',
        ], [
            'petId.required' => 'Pet ID is required',
            'petId.numeric' => 'Pet ID must be a numeric value',
            'categoryName.required' => 'Pet category name is required',
            'categoryName.string' => 'Pet category name must be a string value',
            'categoryName.max' => 'Pet category name must not exceed 255 characters',
            'name.required' => 'Pet name is required',
            'name.string' => 'Pet name must be a string value',
            'name.max' => 'Pet name must not exceed 255 characters',
            'photoUrls.array' => 'Photo URLs must be an array',
            'tagName.required' => 'Tag name is required',
            'tagName.string' => 'Tag name must be a string value',
            'tagName.max' => 'Tag name must not exceed 255 characters',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation exception'], 405);
        }

        $petId = $request->input('petId');
        
        $urlCheck = env('API_URL') . 'pet/' . $petId;
        $responseCheck = Http::get($urlCheck);

        if ($responseCheck->status() == 404) {
            return response()->json(['error' => 'Pet not found'], 404);
        } elseif ($responseCheck->status() == 400) {
            return response()->json(['error' => 'Invalid ID supplied'], 400);
        }

        $url = env('API_URL') . 'pet';
        $data = [
            'id' => $petId,
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
            return response()->json(['error' => 'Error'], 500);
        }
    }
    
    public function updatePetStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'petId' => 'required|numeric',
            'name' => 'required|string|max:255',
            'status' => 'required|in:available,pending,sold',
        ], [
            'petId.required' => 'Pet ID is required',
            'petId.numeric' => 'Pet ID must be a numeric value',
            'name.required' => 'Pet name is required',
            'name.string' => 'Pet name must be a string',
            'name.max' => 'Pet name cannot exceed 255 characters',
            'status.required' => 'Pet status is required',
            'status.in' => 'Invalid status, available values: available, pending, sold',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid input'], 405);
        }

        $petId = $request->input('petId');
        $name = $request->input('name');
        $status = $request->input('status');
        
        $url = env('API_URL').'pet/'.$petId;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, [
            'name' => $name,
            'status' => $status,
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Pet updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update pet');
        }
    }
    public function uploadImage(Request $request)
    {
        $request->validate([
            'petId' => 'required|numeric',
            'photoUrls' => 'required|array', 
            'photoUrls.*' => 'string|url|max:2048',
            'additionalMetadata' => 'nullable|string|max:255',
        ]);

        if (!empty($request->input('photoUrls'))) {
            $photoUrls = $request->input('photoUrls');

            $url = env('API_URL') . 'pet/' . $request->input('petId') . '/uploadImage';

            $response = Http::post($url, [
                'photoUrls' => $photoUrls,
                'additionalMetadata' => $request->input('additionalMetadata'),
            ]);

            if ($response->successful()) {
                return redirect()->back()->with('success', 'Images uploaded successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to upload images');
            }
        }

        return redirect()->back()->with('error', 'No valid image URLs were uploaded');
    }
    public function deletePetById(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'petId' => 'required|numeric'
        ], [
            'petId.required' => 'Pet ID is required',
            'petId.numeric' => 'Pet ID must be a numeric value'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid ID supplied'], 400);
        }
    
        $petId = $request->input('petId');
        
        $url = env('API_URL') . 'pet/' . $petId;
        
        $response = Http::delete($url);
        
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Pet deleted successfully');
        }  elseif ($response->status() == 404) {
            return response()->json(['error' => 'Pet not found'], 404);
        } else {
            return response()->json(['error' => 'Error'], 500);
        }
    }
}

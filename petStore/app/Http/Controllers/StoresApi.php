<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class StoresApi extends Controller
{
    public function storeMainView(){
        $url = env('API_URL').'store/inventory';

        
        $response = Http::get($url);

        if ($response->successful()) {
            return view('store.storeMenu', ['storeMenu' => $response->json()]);
        } else {
            return view('store.storeMenu')->with('error', 'No status');
        }
        return view('store.storeMenu');
    }

    public function addOrder(Request $request)
    {
        $request->validate([
            'petId' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'shipDate' => 'required|date',
        ]);
    
        $url = env('API_URL').'store/order';
    
        // Sending validated data to the API
        $response = Http::post($url, [
            'id' => 0,
            'petId' => $request->input('petId'),
            'quantity' => $request->input('quantity'),
            'shipDate' => $request->input('shipDate'),
            'status' => 'placed',
            'complete' => true,
        ]);
    
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Order added successfully');
        } else {
            return redirect()->back()->with(['error', 'Invalid order'], 400);
        }
    }
    public function getStoreOrder($orderId)
    {
        $url = env('API_URL').'store/order/'.$orderId;

        $response = Http::get($url, [
            'orderId' => $orderId
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

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class StoresApi extends Controller
{
    public function getStoreInventory()
    {
        $url = env('API_URL').'store/inventory';

        $response = Http::get($url);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json([
                'error' => 'Failed to fetch data from API'
            ], 500);
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

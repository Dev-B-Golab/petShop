<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class StoresApi extends Controller
{
    public function storeMainView(){
        return view('store.storeMenu');
    }

    public function storeInventory(){

        $url = env('API_URL').'store/inventory';

        $response = Http::get($url);

        if ($response->successful()) {
            return view('store.storeInventory', ['storeMenu' => $response->json()]);
        } else {
            return view('store.storeInventory')->with('error', 'No status');
        }
    }
    

    public function addOrder(Request $request)
    {
        $request->validate([
            'petId' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'shipDate' => 'required|date',
        ]);
    
        $url = env('API_URL').'store/order';

        $shipDate = new \DateTime($request->input('shipDate'));
        $formattedShipDate = $shipDate->format('Y-m-d\TH:i:s.v\Z');
    
        $response = Http::post($url, [
            'id' => 6,
            'petId' => $request->input('petId'),
            'quantity' => $request->input('quantity'),
            'shipDate' => $formattedShipDate,
            'status' => 'test',
            'complete' => true,
        ]);
    
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Order added successfully');
        } else {
            return redirect()->back()->with(['error', 'Invalid order']);
        }
    }
    public function searchOrderById(Request $request)
    // TODO: error 400
    {
        $request->validate([
            'orderId' => 'required|integer|between:1,10',
        ]);

        $orderId = $request->input('orderId');

        $url = env('API_URL').'store/order/'.$orderId;
    
        $response = Http::get($url);
    
        if ($response->successful()) {
            return view('store.storeById', ['data' => $response->json()]);
        } elseif ($response->status() == 400) {
            return redirect()->back()->with('error', 'Invalid ID supplied');
        } elseif ($response->status() == 404) {
            return redirect()->back()->with('error', 'Order not found');
        } else {
            return redirect()->back()->with('error', 'Failed to fetch data from API');
        }
    }
    public function deleteOrderById(Request $request){

        $request->validate([
            'orderId' => 'required|integer|between:1,10',
        ]);

        $orderId = $request->input('orderId');

        $url = env('API_URL').'store/order/'.$orderId;
    
        $response = Http::delete($url);
    
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Order deleted successfully');
        } elseif ($response->status() == 400) {
            return redirect()->back()->with('error', 'Invalid ID supplied');
        }elseif ($response->status() == 404) {
            return redirect()->back()->with('error', 'Order not found');
        } else {
            return redirect()->back()->with('error', 'Failed to delete order');
        }
    }
}

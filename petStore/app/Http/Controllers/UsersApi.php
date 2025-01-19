<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class UsersApi extends Controller
{
    public function userMainView(){
        return view('user.userMenu');
    }

    public function getUser(Request $request)
    {
        $username = $request->input('username');
        $url = env('API_URL').'user/'.$username;

        $response = Http::get($url);

         if ($response->successful()) {
            return view('user.userByName', ['data' => $response->json()]);
        } else {
            return redirect()->back()->with('error', $response->json()['message']." code:". 404);
        }
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $url = env('API_URL').'user/login';

        $response = Http::get($url, [
            'username' => $username,
            'password' => $password
        ]);

        if ($response->successful()) {
            preg_match('/session:(\d+)/', $response->json()['message'], $matches);
            session(['token' => $matches[1]]);
            return redirect('/userMenu');
        } else {
            return redirect()->back()->with('error', 'Invalid username/password supplied');
        }

    }
    public function logout()
    {
        session()->forget('token');
        return redirect('/userMenu');
    }

    public function addUser(Request $request)
    {
        if(session('token') == null){
            return redirect()->back()->with('error', 'You must be logged in to add a user');
        }
        $request->validate([
            'username' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
            'phone' => '|string|max:15',
            'userStatus' => '|integer|between:0,1',
        ]);

        $data = [
            "id" => 0,  
            "username" => $request->input('username'),
            "firstName" => $request->input('firstName'),
            "lastName" => $request->input('lastName'),
            "email" => $request->input('email'),
            "password" => $request->input('password'),
            "phone" => $request->input('phone'),
            "userStatus" => $request->input('userStatus')
        ];

        $url = env('API_URL') . 'user';

        $response = Http::post($url, $data);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'User added successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to add user');
        }
    }
    public function updateUser(Request $request)
    {
        if(session('token') == null){
            return redirect()->back()->with('error', 'You must be logged in to update a user');
        }
        $request->validate([
            'username' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
            'phone' => '|string|max:15',
            'userStatus' => '|integer|between:0,1',
        ]);

        $data = [
            "id" => 0,  
            "username" => $request->input('username'),
            "firstName" => $request->input('firstName'),
            "lastName" => $request->input('lastName'),
            "email" => $request->input('email'),
            "password" => $request->input('password'),
            "phone" => $request->input('phone'),
            "userStatus" => $request->input('userStatus')
        ];

        $url = env('API_URL').'user/'.$request->input('username');

        $response = Http::put($url, $data);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'User updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update user');
        }
    }
    public function deleteUser(Request $request)
    {
        if(session('token') == null){
            return redirect()->back()->with('error', 'You must be logged in to delete a user');
        }
        $username = $request->input('username');

        $url = env('API_URL').'user/'.$username;

        $response = Http::delete($url);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'User deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to delete user');
        }
    }

}

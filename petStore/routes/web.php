<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetStore;
use App\Http\Controllers\PetsApi;
use App\Http\Controllers\StoresApi;
use App\Http\Controllers\UsersApi;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Pets views
Route::get('/petsMenu', [PetStore::class, 'petMainView']);

Route::get('/petsMenu/id', [PetsApi::class, 'getPetsById']);

// Store views
Route::get('/storeMenu', [PetStore::class, 'storeMainView']);

// User views
Route::get('/userMenu', [PetStore::class, 'userMainView']);

// Pets API
Route::get('/pets/findByStatus', [PetsApi::class, 'getPetsByStatus']);

Route::get('/pets/{id}', [PetsApi::class, 'getPetsById']);

// Stores API
Route::get('/store/inventory', [StoresApi::class, 'getStoreInventory']);

Route::get('/store/order/{orderId}', [StoresApi::class, 'getStoreOrder']);

// Users API

Route::get('/user/{username}', [UsersApi::class, 'getUser']);
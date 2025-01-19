<?php

use Illuminate\Support\Facades\Route;
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
Route::get('/petsMenu', [PetsApi::class, 'petMainView']);

Route::get('/petsMenu/id', [PetsApi::class, 'getPetsById']);

Route::get('/petsMenu/status', [PetsApi::class, 'getPetsByStatus']);

Route::post('/petsMenu/addPet', [PetsApi::class, 'addPet']);

Route::delete('/petsMenu/delete', [PetsApi::class, 'deletePetById']);

Route::put('/petsMenu/updatePet', [PetsApi::class, 'updatePet']);

Route::post('/petsMenu/updatePetStatus', [PetsApi::class, 'updatePetStatus']);

Route::post('/pet/{petId}/uploadImage', [PetsApi::class, 'uploadImage']);

// Store views
Route::get('/storeMenu', [StoresApi::class, 'storeMainView']);

Route::get('/storeMenu/storeInventory', [StoresApi::class, 'storeInventory']);

Route::post('/storeMenu/addOrder', [StoresApi::class, 'addOrder']);

Route::get('/storeMenu/orderById', [StoresApi::class, 'searchOrderById']);

Route::delete('/storeMenu/deleteOrder', [StoresApi::class, 'deleteOrderById']);

// User views
Route::get('/userMenu', [UsersApi::class, 'userMainView']);

Route::get('/userMenu/userByName', [UsersApi::class, 'getUser']);

Route::get('/userMenu/login', [UsersApi::class, 'login']);

Route::get('/userMenu/logout', [UsersApi::class, 'logout']);

Route::post('/userMenu/addUser', [UsersApi::class, 'addUser']);

Route::put('/userMenu/updateUser', [UsersApi::class, 'updateUser']);

Route::delete('/userMenu/deleteUser', [UsersApi::class, 'deleteUser']);

Route::post('/userMenu/createWithArray', [UsersApi::class, 'addUserArray']);

Route::post('/userMenu/createWithList', [UsersApi::class, 'addUserList']);
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetsApi;

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

Route::post('/pet/uploadImage', [PetsApi::class, 'uploadImage']);

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PetsApi;
use App\Http\Controllers\StoresApi;
use App\Http\Controllers\UsersApi;


class PetStore extends Controller
{
    public function petMainView(){
        return view('pet.petsMenu');
    }

    public function storeMainView(){
        return view('store.storeMenu');
    }

    public function userMainView(){
        return view('user.userMenu');
    }
}

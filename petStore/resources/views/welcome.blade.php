@extends('layout.layout')

@section('title', 'Pet Store')
@section('content')
    <div class="row h-100 align-items-center justify-content-center text-center mt-5">
        <div class="col-sm-4">
            <a class="btn btn-primary btn-lg" href="/petsMenu">Pets</a>
        </div>
        <div class="col-sm-4">
            <a class="btn btn-secondary btn-lg" href="/storeMenu">Store</a>
        </div>
        <div class="col-sm-4">
            <a class="btn btn-dark btn-lg" href="/userMenu">User</a>
        </div>
    </div>
@endsection


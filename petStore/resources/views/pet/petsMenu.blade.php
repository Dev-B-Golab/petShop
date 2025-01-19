@extends('layout.layout')

@section('title', 'Pet Menu')
@section('content')
    <div class="row mt-5">
        <div class="col-sm-6">
            <form action="/petsMenu/id" method="GET">
                @csrf
                <h2>Find pet by ID (GET:/pet/petId)</h2>
                <div class="form-group mb-3">
                    <label for="petId">Id</label>
                    <input type="text" class="form-control" id="petId" name="petId" value="34567">
                </div>
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        </div>
        <div class="col-sm-6">
            <form action="/petsMenu/status" method="GET">
                @csrf
                <h2>Find pet by status (GET:/pet/findByStatus)</h2>
                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="available" selected>Available</option>
                        <option value="pending">Pending</option>
                        <option value="sold">Sold</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <form action="/petsMenu/addPet" method="POST">
                @csrf
                <h2>Add new pet (POST:/pet)</h2>
                <div class="form-group">
                    <!-- Category -->
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName" value="string">
                    </div>
        
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="doggie">
                    </div>
        
                    <!-- Photo URLs -->
                    <div class="mb-3">
                        <label for="photoUrls" class="form-label">Photo URLs</label>
                        <input type="text" class="form-control" id="photoUrls" name="photoUrls[]" value="string">
                    </div>
        
                    <!-- Tags -->
                    <div class="mb-3">
                        <label for="tagName" class="form-label">Tag Name</label>
                        <input type="text" class="form-control" id="tagName" name="tagName" value="string">
                    </div>
        
                    <!-- Status -->
                    <input type="hidden" name="status" value="available">
        
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <div class="col-sm-6">
            <form action="/petsMenu/delete" method="POST">
                @csrf
                @method('DELETE')
                <h2>Delete pet by id (DELETE:/pet/petId)</h2>
                <div class="form-group">
                    <!-- ID -->
                    <div class="mb-3">
                        <label for="petId" class="form-label">ID</label>
                        <input type="number" class="form-control" id="petId" name="petId" placeholder="Enter Pet ID" required>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </form>
        </div>
    </div>
@endsection
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
                    <input type="text" class="form-control" id="status" name="status" value="">
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
                        <label for="photoUrl1" class="form-label">Photo URL 1:</label>
                        <input type="text" name="photoUrls[]" id="photoUrl1" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="photoUrl2" class="form-label">Photo URL 2:</label>
                        <input type="text" name="photoUrls[]" id="photoUrl2" class="form-control">
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
            <form action="/petsMenu/updatePetStatus" method="POST">
                @csrf
                <h2>Update pet (POST:/pet/{petId})</h2>
                <div class="form-group">
                    <!-- ID -->
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Id</label>
                        <input type="text" class="form-control" required name="petId" id="petId" value="">
                    </div>
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="">
                    </div>
                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status" value="">
                    </div>
        
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            <form action="/pet/uploadImage" method="POST">
                @csrf
                <h2>Insert image (POST:/pet/uploadImage)</h2>
                <div class="form-group">
                    <!-- Pet ID -->
                    <div class="mb-3">
                        <label for="petId" class="form-label">Pet ID</label>
                        <input type="text" class="form-control" required name="petId" id="petId" value="{{ old('petId') }}">
                    </div>
                    
                    <!-- Additional Metadata -->
                    <div class="mb-3">
                        <label for="additionalMetadata" class="form-label">Additional data to pass to server</label>
                        <input type="text" class="form-control" id="additionalMetadata" name="additionalMetadata" value="{{ old('additionalMetadata') }}">
                    </div>
            
                    <!-- Photo URLs -->
                    <div class="mb-3">
                        <label for="photoUrls" class="form-label">Photo URLs</label>
                        <input type="text" class="form-control" name="photoUrls[]" value="">
                        <input type="text" class="form-control mt-2" name="photoUrls[]" value="">
                        <!-- Można dodać więcej inputów dla więcej zdjęć -->
                    </div>
            
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Upload</button>
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
                        <input type="text" class="form-control" id="petId" name="petId" required>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </form>
            <form action="/petsMenu/updatePet" method="POST">
                @csrf
                @method('PUT')
                <h2 class="mt-5">Update pet (PUT:/pet)</h2>
                <div class="form-group">
                    <!-- ID -->
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Id</label>
                        <input type="text" class="form-control" name="petId" id="petId" value="">
                    </div>
                    <!-- Category -->
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName" value="">
                    </div>
        
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="">
                    </div>
        
                    <!-- Photo URLs -->
                    <div class="mb-3">
                        <label for="photoUrl1" class="form-label">Photo URL 1:</label>
                        <input type="text" name="photoUrls[]" id="photoUrl1" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="photoUrl2" class="form-label">Photo URL 2:</label>
                        <input type="text" name="photoUrls[]" id="photoUrl2" class="form-control">
                    </div>
        
                    <!-- Tags -->
                    <div class="mb-3">
                        <label for="tagName" class="form-label">Tag Name</label>
                        <input type="text" class="form-control" id="tagName" name="tagName" value="">
                    </div>
            
                    <!-- Status -->
                    <input type="hidden" name="status" value="available">
        
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
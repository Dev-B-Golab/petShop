@extends('layout.layout')

@section('title', 'Finded Pet by ID')
@php
// dd($pet);
@endphp
@section('content')
    <div class="row mt-5">
        <div class="col-sm-12">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        {{-- usunac --}}
                        <th>Category ID</th> 
                        <th>Category Name</th>
                        <th>Name</th>
                        <th>Photo URLs</th>
                        <th>Tags</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ isset($pet['id']) ? $pet['id'] : '' }}</td>
                        {{-- usunac --}}
                        <td>{{ isset($pet['category']['id']) ? $pet['category']['id'] : ''}}</td>
                        <td>{{ isset($pet['category']['name']) ? $pet['category']['name'] : ''}}</td>
                        <td>{{ isset($pet['name']) ? $pet['name'] : '' }}</td>
                        <td>
                            @foreach ($pet['photoUrls'] as $photoUrl)
                                <a href="{{ $photoUrl }}">{{ $photoUrl }}</a><br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($pet['tags'] as $tag)
                                {{ isset($tag['name']) ? $tag['name'] : '' }}<br>
                            @endforeach
                        </td>
                        <td>{{ isset($pet['status']) ? $pet['status'] : '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-sm-4">
            <form action="/petsMenu/updatePet" method="POST">
                @csrf
                @method('PUT')
                <h2>Update pet (PUT:/pet)</h2>
                <div class="form-group">
                    <!-- ID -->
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Id</label>
                        <input type="text" class="form-control" required name="petId" id="petId" value="<?= $pet['id']?>">
                    </div>
                    <!-- Category -->
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName" value="<?= isset($pet['category']['name']) ? $pet['category']['name'] : '' ?>">
                    </div>
        
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= isset($pet['name']) ? $pet['name'] : '' ?>">
                    </div>
        
                    <!-- Photo URLs -->
                    <div class="mb-3">
                        <label for="photoUrls" class="form-label">Photo URLs</label>
                        <input type="text" class="form-control" id="photoUrls" name="photoUrls[]" value="<?= $pet['photoUrls'][0]?>">
                    </div>
        
                    <!-- Tags -->
                    <div class="mb-3">
                        <label for="tagName" class="form-label">Tag Name</label>
                        <input type="text" class="form-control" id="tagName" name="tagName" value="<?= isset($pet['tags'][0]['name']) ? $pet['tags'][0]['name'] : '' ?>">
                    </div>
            
                    <!-- Status -->
                    <input type="hidden" name="status" value="available">
        
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
        <div class="col-sm-4">
            <form action="/petsMenu/updatePetStatus" method="POST">
                @csrf
                <h2>Update pet (POST:/pet/{petId})</h2>
                <div class="form-group">
                    <!-- ID -->
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Id</label>
                        <input type="text" class="form-control" required name="petId" id="petId" value="<?= $pet['id']?>">
                    </div>
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= isset($pet['name']) ? $pet['name'] : '' ?>">
                    </div>
                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="available">Available</option>
                            <option value="pending">Pending</option>
                            <option value="sold">Sold</option>
                        </select>
                    </div>
        
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
        <div class="col-sm-4">
            <form action="/pet/{{ $pet['id'] }}/uploadImage" method="POST" enctype="multipart/form-data">
                @csrf
                <h2>Insert image (POST:/pet/{petId}/uploadImage)</h2>
                <div class="form-group">
                    <!-- ID -->
                    <div class="mb-3">
                        <label for="petId" class="form-label">Id</label>
                        <input type="text" class="form-control" required name="petId" id="petId" value="{{ $pet['id'] }}">
                    </div>
                    <!-- Additional Metadata -->
                    <div class="mb-3">
                        <label for="additionalMetadata" class="form-label">Additional data to pass to server</label>
                        <input type="text" class="form-control" id="additionalMetadata" name="additionalMetadata" value="">
                    </div>
                    <!-- Photo -->
                    <div class="mb-3">
                        <label for="photoUrls" class="form-label">Photo</label>
                        <input type="file" class="form-control" id="photoUrls" name="photoUrls" accept="image/*">
                    </div>
            
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@extends('layout.layout')

@section('title', 'Finded Pet by Status')

@section('content')
    <div class="row mt-5">
        <div class="col-sm-12">
            @if(isset($pets))
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Name</th>
                        <th>Photo URLs</th>
                        <th>Tags</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pets as $key => $pet)
                    <tr>
                        <td>{{ isset($pet['id']) ? $pet['id'] : '' }}</td>
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
                        <td>{{ $pet['status'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @elseif(isset($error))
                <h1>Error</h1>
                <p>{{ $error }}</p>
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-end">
        {{ $pets->links('vendor.pagination.bootstrap-5') }}
    </div>
    <div class="row mt-5">
        <div class="col-sm-12">
            {{-- <a href="/petsMenu" class="btn btn-warning">Update</a>
            <a href="/petsMenu" class="btn btn-danger">Delete</a> --}}
        </div>
    </div>
@endsection
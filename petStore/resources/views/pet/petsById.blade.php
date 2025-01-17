@extends('layout.layout')

@section('title', 'Finded Pet')

@section('content')
    <div class="row mt-5">
        <div class="col-sm-12">
            @if(isset($pet))
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
                    <tr>
                        <td>{{ $pet['id'] }}</td>
                        <td>{{ $pet['category']['id'] }}</td>
                        <td>{{ $pet['category']['name'] }}</td>
                        <td>{{ $pet['name'] }}</td>
                        <td>
                            @foreach ($pet['photoUrls'] as $photoUrl)
                                <a href="{{ $photoUrl }}">{{ $photoUrl }}</a><br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($pet['tags'] as $tag)
                                {{ $tag['name'] }}<br>
                            @endforeach
                        </td>
                        <td>{{ $pet['status'] }}</td>
                    </tr>
                </tbody>
            </table>
            @elseif(isset($error))
            <h1>Error</h1>
            <p>{{ $error }}</p>
            @endif
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-sm-12">
            <a href="/petsMenu" class="btn btn-warning">Update</a>
            <a href="/petsMenu" class="btn btn-danger">Delete</a>
        </div>
    </div>
@endsection
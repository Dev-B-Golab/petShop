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
            
        </div>
        <div class="col-sm-4">
            
        </div>
        <div class="col-sm-4">
            
        </div>
    </div>
@endsection
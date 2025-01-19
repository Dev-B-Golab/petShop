@extends('layout.layout')

@section('title', 'User by name')
@section('content')
@php
//  dd($data);   
@endphp
    <div class="row mt-5">
        <div class="col-md-12">
            @if (isset($data))
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Phone</th>
                        <th>userStatus</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>{{ $data['username'] }}</td>
                            <td>{{ $data['firstName'] }}</td>
                            <td>{{ $data['lastName'] }}</td>
                            <td>{{ $data['email'] }}</td>
                            <td>{{ $data['password'] }}</td>
                            <td>{{ $data['phone'] }}</td>
                            <td>{{ $data['userStatus'] }}</td>
                        </tr>
                </tbody>
            </table>
            @else
                <p>No status available</p>
            @endif
        </div>
    </div>
@endsection
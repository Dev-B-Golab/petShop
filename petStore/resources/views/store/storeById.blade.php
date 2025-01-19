@extends('layout.layout')

@section('title', 'Store by ID')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            @if (isset($data))
            <h2>(GET)/store/order/{orderId}</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Pet Id</th>
                        <th>Quantity</th>
                        <th>ShipDate</th>
                        <th>Status</th>
                        <th>Complete</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>{{ $data['petId'] }}</td>
                            <td>{{ $data['quantity'] }}</td>
                            <td>{{ $data['shipDate'] }}</td>
                            <td>{{ $data['status'] }}</td>
                            <td>{{ $data['complete'] }}</td>
                        </tr>
                </tbody>
            </table>
            @else
                <p>No status available</p>
            @endif
        </div>
    </div>
@endsection
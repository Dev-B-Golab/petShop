@extends('layout.layout')

@section('title', 'Store Menu')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            @if (isset($storeMenu))
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($storeMenu as $status => $quantity)
                        <tr>
                            <td>{{ $status }}</td>
                            <td>{{ $quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p>No status available</p>
            @endif
        </div>
    </div>
@endsection
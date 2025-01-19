@extends('layout.layout')

@section('title', 'Store Menu')
@section('content')
    <div class="row mt-5">
        <div class="col-md-6">
            <h2>Pet order (POST /store/order)</h2>
            <form action="/storeMenu/addOrder" method="POST">
                @csrf
                <div class="form-group">
                    <div>
                        <label for="petId" class="form-label">Pet ID</label>
                        <input type="number" class="form-control" name="petId" id="petId" required>
                    </div>
                    <div>
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" required>
                    </div>
                    <div>
                        <label for="shipDate" class="form-label">Ship Date</label>
                        <input type="datetime-local" class="form-control" name="shipDate" id="shipDate" required>
                    </div>
    
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            @if (isset($storeMenu))
            <h2>(GET)/store/inventory</h2>
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
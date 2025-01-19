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
            <h2>Search pet order (GET) /store/order{orderId}</h2>
            <form action="/storeMenu/orderById" method="GET">
                @csrf
                <div class="form-group">
                    <div>
                        <label for="orderId" class="form-label">Pet ID</label>
                        <input type="number" class="form-control" name="orderId" id="orderId" required>
                    </div>
    
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </div>
            </form>
            <h2>Delete pet order (DELETE) /store/order{orderId}</h2>
            <form action="/storeMenu/deleteOrder" method="POST">
                @csrf
                @method('DELETE')
                <div class="form-group">
                    <div>
                        <label for="orderId" class="form-label">Pet ID</label>
                        <input type="number" class="form-control" name="orderId" id="orderId" required>
                    </div>
    
                    <button type="submit" class="btn btn-danger mt-2">Delete</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <h2>(GET)/store/inventory</h2>
            <a class="btn btn-primary" href="/storeMenu/storeInventory">Inventory</a>
        </div>
    </div>
@endsection
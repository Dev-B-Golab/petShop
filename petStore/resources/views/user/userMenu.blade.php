@extends('layout.layout')

@section('title', 'User Menu')
@section('content')
    <div class="row mt-5">
        <div class="col-md-6">
            <h2>User by ID (GET)/user/{username}</h2>
            <form action="/userMenu/userByName" method="GET">
                @csrf
                <div class="form-group">
                    <!-- Username -->
                    <div>
                        <label for="username" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
    
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            @if(session('token'))
            <a class="btn btn-primary" href="/userMenu/logout">Logout</a>

            <h2>New user (POST)/user/{username}</h2>
            <form action="/userMenu/addUser" method="POST">
                @csrf
                <!-- Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
                </div>
        
                <!-- First Name -->
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First Name" required>
                </div>
        
                <!-- Last Name -->
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" required>
                </div>
        
                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                </div>
        
                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                </div>
        
                <!-- Phone -->
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" required>
                </div>
        
                <!-- User Status -->
                <div class="form-group">
                    <label for="userStatus">User Status</label>
                    <select class="form-control" id="userStatus" name="userStatus" required>
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>
                </div>
        
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <h2>Update user (PUT)/user/{username}</h2>
            <form action="/userMenu/updateUser" method="POST">
                @csrf
                @method('PUT')
                <!-- Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
                </div>
        
                <!-- First Name -->
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First Name" required>
                </div>
        
                <!-- Last Name -->
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" required>
                </div>
        
                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                </div>
        
                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                </div>
        
                <!-- Phone -->
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" required>
                </div>
        
                <!-- User Status -->
                <div class="form-group">
                    <label for="userStatus">User Status</label>
                    <select class="form-control" id="userStatus" name="userStatus" required>
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>
                </div>
        
                <button type="submit" class="btn btn-primary">Update</button>
            </form>

            <h2>Delete by ID (DELETE)/user/{username}</h2>
            <form action="/userMenu/deleteUser" method="POST">
                @csrf
                @method('DELETE')
                <div class="form-group">
                    <!-- Username -->
                    <div>
                        <label for="username" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
    
                    <button type="submit" class="btn btn-danger mt-2">Delete</button>
                </div>
            </form>
            @else
            <h2>Login (GET)/user/{login}</h2>
            <form action="/userMenu/login" method="GET">
                @csrf
                <div class="form-group">
                    <!-- Username -->
                    <div>
                        <label for="username" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <!-- Password -->
                    <div>
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Login</button>
                </div>
            </form>
            @endif
        </div>
    </div>
@endsection
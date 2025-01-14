@extends('backend.layouts.master')

@section('title')
    My Profile
@endsection

@section('content')
<div class="container-fluid d-flex justify-content-center align-items-center ">
    <div class="row w-100">
        <!-- Main Content -->
        <div class="col-12">
            <!-- Profile Edit Card -->
            <div class="card m-0 p-0">
                <div class="card-header">
                    <h3>Edit Profile</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- phone  --}}

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="phone" name="phone" id="email" class="form-control" value="{{ old('email', Auth::user()->phone) }}" required>
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        </div>

                        <!-- Avatar -->
                        <div class="form-group">
                            <label for="avatar">Profile Picture</label>
                            <input type="file" name="avatar" id="avatar" class="form-control">
                            @error('avatar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            @if(Auth::user()->image)
                            <div class="mt-2">
                                <img src="{{ asset(Auth::user()->image) }}" alt="Avatar" width="100">
                            </div>
                        @endif
                        
                        </div>

                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
            <!-- End Profile Edit Card -->
        </div>
    </div>
</div>


@endsection

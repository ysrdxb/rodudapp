@extends('layouts.app')

@section('content')
    <div class="container py-12">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
            {{ __('Profile') }}
        </h2>

        <!-- Update Profile Information Form -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Update Profile Information</h5>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <!-- Update Password Form -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Update Password</h5>
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <!-- Delete User Form -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Delete Account</h5>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
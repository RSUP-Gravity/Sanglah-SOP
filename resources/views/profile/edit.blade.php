@extends('layouts.dashboard')

@section('title', 'Profil Pengguna')
@section('page-title', 'Pengaturan Profil')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Profile Info -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="max-w-xl">
             @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <!-- Password Update -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <!-- Delete Account -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection

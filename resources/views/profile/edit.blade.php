@extends('Template.Index') {{-- Menggunakan layout utama dari SBAdmin 2 --}}

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Profile</h1>

            <!-- Notifikasi -->
            @if (session('success'))
            <div id="alert-success" class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if (session('error'))
            <div id="alert-error" class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-lg-6">
                    <!-- Update Profile Information -->
                    <div class="card shadow-sm mb-4 border-left-primary">
                        <div class="card-header bg-primary text-white">
                            <h6 class="m-0 font-weight-bold">Update Profile Information</h6>
                        </div>
                        <div class="card-body">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="card shadow-sm mb-4 border-left-warning">
                        <div class="card-header bg-warning text-white">
                            <h6 class="m-0 font-weight-bold">Update Password</h6>
                        </div>
                        <div class="card-body">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-lg-6">
                    <!-- Delete Account -->
                    <div class="card shadow-sm mb-4 border-left-danger">
                        <div class="card-header bg-danger text-white">
                            <h6 class="m-0 font-weight-bold">Delete Account</h6>
                        </div>
                        <div class="card-body">
                            {{-- @include('profile.partials.delete-user-form') --}}
                        </div>
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="card shadow-sm mb-4 border-left-info">
                        <div class="card-header bg-info text-white">
                            <h6 class="m-0 font-weight-bold">Account Information</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p><strong>Joined:</strong> {{ Auth::user()->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Notifikasi otomatis menghilang setelah 5 detik
    setTimeout(() => {
        document.getElementById('alert-success')?.classList.add('fade-out');
        document.getElementById('alert-error')?.classList.add('fade-out');
    }, 5000);
</script>

<style>
    .fade-out {
        opacity: 0;
        transition: opacity 1s ease-out;
    }
</style>
@endsection

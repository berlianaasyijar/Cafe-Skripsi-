@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <!-- Foto Profil -->
                    @if( Session::get('karyawan_foto'))
    <img src="{{ Session::get('karyawan_foto') }}" alt="Profile Image" class="rounded-circle" style="max-width: 150px; max-height: 150px;">
@else
    <p>No image available</p>
@endif


                    <!-- Nama Karyawan -->
                    <h2>{{ $karyawan['nama'] }}</h2>
                    <div class="social-links mt-2">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card">
                <div class="card-body pt-3">
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active" id="profile-overview">
                            <h5 class="card-title">Detail Profil</h5>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nama Lengkap</div>
                                <div class="col-lg-9 col-md-8">{{ $karyawan['nama'] }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Tempat Kerja</div>
                                <div class="col-lg-9 col-md-8">Cafe99</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">{{ $karyawan['email'] }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">No. HP</div>
                                <div class="col-lg-9 col-md-8">{{ $karyawan['no_hp'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

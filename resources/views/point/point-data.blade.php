@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Tukar Point</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Point</li>
            <li class="breadcrumb-item active">Tukar Point</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tukar Point Member</h5>

                    <!-- General Form Elements -->
                    <form action="{{ route('points.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone" class="col-sm-2 col-form-label">No Handphone</label>
                            <div class="col-sm-10">
                                <input type="text" id="phone" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="reason" class="col-sm-2 col-form-label">Alasan</label>
                            <div class="col-sm-10">
                                <input type="text" id="reason" name="reason" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="points" class="col-sm-2 col-form-label">Jumlah Point</label>
                            <div class="col-sm-10">
                                <select id="points" name="points" class="form-select" required>
                                    <option value="" selected disabled>Pilih Jumlah Point</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="300">300</option>
                                    <option value="400">400</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10 d-flex justify-content-center text-center">
                                <button type="submit" class="btn btn-primary">Tukar Point</button>
                            </div>
                        </div>
                    </form><!-- End General Form Elements -->

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@extends('layouts.app')

@section('content')
    <div class="pagetitle">
      <h1>Tambah Member</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Member</li>
          <li class="breadcrumb-item active">Tambah Member</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Member Cafe</h5>
                    <form action="{{ route('member.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">No Handphone</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_hp" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Point</label>
                            <div class="col-sm-10">
                                <input type="number" name="point" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10 text-center">
                                <button type="submit" class="btn btn-primary">Tambah Member</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
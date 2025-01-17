@extends('layouts.app')

@section('content')
    <div class="pagetitle">
      <h1>Tambah karyawan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">karyawan</li>
          <li class="breadcrumb-item active">Tambah karyawan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Karyawan Cafe</h5>
                    <form action="{{ route('karyawans.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input type="file" name="foto" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10 text-center">
                                <button type="submit" class="btn btn-primary">Tambah Karyawan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
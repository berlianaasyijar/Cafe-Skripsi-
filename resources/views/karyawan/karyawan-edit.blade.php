@extends('layouts.app')

@section('content')
    <div class="pagetitle">
      <h1>Edit karyawan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">karyawan</li>
          <li class="breadcrumb-item active">Edit karyawan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Karyawan Cafe</h5>
                    <form action="{{ route('karyawans.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" class="form-control" value="{{ $karyawan->nama }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" class="form-control" value="{{ $karyawan->username }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">No Handphone</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_hp" class="form-control" value="{{ $karyawan->no_hp }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Point</label>
                            <div class="col-sm-10">
                                <select name="point" class="form-select" required>
                                    <option value="0" {{ $karyawan->point == 0 ? 'selected' : '' }}>0</option>
                                    <option value="10" {{ $karyawan->point == 10 ? 'selected' : '' }}>10</option>
                                    <option value="15" {{ $karyawan->point == 15 ? 'selected' : '' }}>15</option>
                                    <option value="20" {{ $karyawan->point == 20 ? 'selected' : '' }}>20</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input type="file" name="foto" class="form-control" accept="image/*">
                                @if ($karyawan->foto)
                                    <img src="{{ asset('storage/' . $karyawan->foto) }}" alt="Foto Karyawan" class="img-thumbnail mt-2" width="100">
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10 d-flex justify-content-center text-center">
                                <button type="submit" class="btn btn-primary">Update Karyawan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection
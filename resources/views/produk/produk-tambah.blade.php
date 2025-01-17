@extends('layouts.app')

@section('content')
    <div class="pagetitle">
      <h1>Tambah Produk</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Produk</li>
          <li class="breadcrumb-item active">Tambah Produk</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Produk Menu</h5>

       <!-- General Form Elements -->
<form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf <!-- Token CSRF untuk keamanan -->
    
    <div class="row mb-3">
        <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
        <div class="col-sm-10">
            <input type="text" name="nama_produk" id="nama_produk" class="form-control" required>
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
        <div class="col-sm-10">
            <input type="text" name="deskripsi" id="deskripsi" class="form-control">
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
        <div class="col-sm-10">
            <input type="number" name="harga" id="harga" class="form-control" required>
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="gambar_produk" class="col-sm-2 col-form-label">Gambar Produk</label>
        <div class="col-sm-10">
            <input type="file" name="gambar_produk" id="gambar_produk" class="form-control">
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
        <div class="col-sm-10">
            <select name="kategori" id="kategori" class="form-select" required>
                <option value="" disabled selected>Pilih kategori</option>
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
                <option value="Camilan">Camilan</option>
            </select>
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-sm-10 d-flex justify-content-center text-center">
            <button type="submit" class="btn btn-primary">Tambah Produk</button>
        </div>
    </div>
</form>
<!-- End General Form Elements -->

            </div>
          </div>

            </div>
          </div>

        </div>
      </div>
    </section>

@endsection
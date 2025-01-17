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

<div class="container">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Produk</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Method spoofing untuk update -->

                        <div class="row mb-3">
                            <label for="nama_produk" class="col-sm-3 col-form-label">Nama Produk</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga', $produk->harga) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gambar_produk" class="col-sm-3 col-form-label">Gambar Produk</label>
                            <div class="col-sm-9">
                                <input type="file" name="gambar_produk" id="gambar_produk" class="form-control">
                                @if($produk->gambar_produk)
    <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="Product Image" class="img-fluid" style="max-width: 150px; max-height: 150px;">
@else
    <p>No image availadfble</p>
@endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kategori" class="col-sm-3 col-form-label">Kategori</label>
                            <div class="col-sm-9">
                                <select name="kategori" id="kategori" class="form-select" required>
                                    <option value="" disabled>Pilih kategori</option>
                                    <option value="Makanan" {{ old('kategori', $produk->kategori) == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                    <option value="Minuman" {{ old('kategori', $produk->kategori) == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                    <option value="Camilan" {{ old('kategori', $produk->kategori) == 'Camilan' ? 'selected' : '' }}>Camilan</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary">Update Produk</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
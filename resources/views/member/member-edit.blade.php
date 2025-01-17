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
          <h5 class="card-title">Edit Member Cafe</h5>

          <!-- General Form Elements -->
          <form action="{{ route('member.update', $member->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
              <label for="nama" class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" id="nama" name="nama" class="form-control" value="{{ $member->nama }}">
              </div>
            </div>

            <div class="row mb-3">
              <label for="username" class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-10">
                <input type="text" id="username" name="username" class="form-control" value="{{ $member->username }}">
              </div>
            </div>

            <div class="row mb-3">
              <label for="no_hp" class="col-sm-2 col-form-label">No Handphone</label>
              <div class="col-sm-10">
                <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ $member->no_hp }}">
              </div>
            </div>

            <div class="row mb-3">
              <label for="point" class="col-sm-2 col-form-label">Point</label>
              <div class="col-sm-10">
                <select id="point" name="point" class="form-select">
                  <option value="0" {{ $member->point == 0 ? 'selected' : '' }}>0</option>
                  <option value="10" {{ $member->point == 10 ? 'selected' : '' }}>10</option>
                  <option value="15" {{ $member->point == 15 ? 'selected' : '' }}>15</option>
                  <option value="20" {{ $member->point == 20 ? 'selected' : '' }}>20</option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-10 d-flex justify-content-center text-center">
                <button type="submit" class="btn btn-primary">Update Member</button>
              </div>
            </div>

          </form><!-- End General Form Elements -->

        </div>
      </div>
    </div>
  </div>
</section>



@endsection
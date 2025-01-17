@extends('layouts.app')

@section('content')
    <div class="pagetitle">
      <h1>Data karyawan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">karyawan</li>
          <li class="breadcrumb-item active">Data karyawan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data karyawan</h5>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>No Hp</th>
                                <th>Password</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tbody>
                            @foreach($karyawans as $karyawan)
                                <tr>
                                    <td>{{ $karyawan->nama }}</td>
                                    <td>{{ $karyawan->username }}</td>
                                    <td>{{ $karyawan->no_hp }}</td>
                                    <td>********</td> <!-- Hide the password for security -->
                                    <td>{{ $karyawan->email }}</td>
                                    <td>
                                        <a href="{{ route('karyawans.edit', $karyawan->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('karyawans.destroy', $karyawan->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

@endsection
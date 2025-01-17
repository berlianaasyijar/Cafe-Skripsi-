@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Transaksi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Transaksi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Main Section -->
    <div class="container text-center mt-5">
        <div class="card shadow-lg p-4 mb-4 rounded">
            <div class="card-body">
                <h1 class="display-4 text-success">Terima Kasih!</h1>
                <p class="lead">Transaksi Anda akan segera diproses oleh kasir.</p>
                <p class="text-muted mb-4">Kami menghargai kesabaran Anda dalam menunggu proses selanjutnya.</p>

                <a href="{{ route('points.index') }}" class="btn btn-success btn-lg">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>


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

@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Data Transaksi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Transaksi</li>
            <li class="breadcrumb-item active">Detail Transaksi</li>
        </ol>
    </nav>
    
</div>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Detail Transaksi</h2>
        </div>
        <div class="card-body">
            <div class="row mb-3 mt-2">
                <div class="col-md-6">
                    <p><strong>Total Harga:</strong> <span class="text-primary">Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</span></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Status:</strong>
                        @if($transaction->status == 2)
                            <span class="badge bg-warning">Butuh Persetujuan</span>
                        @elseif($transaction->status == 1)
                            <span class="badge bg-success">Berhasil</span>
                        @else
                            <span class="badge bg-secondary">Pending</span>
                        @endif
                    </p>
                </div>
            </div>
            <p><strong>Dibuat Pada:</strong> {{ $transaction->created_at->format('d-m-Y H:i') }}</p>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Produk</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-end">Harga</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->details as $detail)
                    <tr>
                        <td>{{ $detail->produk->nama_produk }}</td>
                        <td class="text-center">{{ $detail->jumlah }}</td>
                        <td class="text-end">Rp {{ number_format($detail->produk->harga, 0, ',', '.') }}</td>
                        <td class="text-end">Rp {{ number_format($detail->jumlah * $detail->produk->harga, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
 
       
    </div>

    <div class="text-end mt-4">
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection

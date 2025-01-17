@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
 <div class="row">
        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-6 mb-3">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Menu <span>| Cafe</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $totalMenu }}</h6>
                  <span class="text-muted small pt-2 ps-1">Total Menu</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Sales Card -->

        <!-- Customers Card -->
        <div class="col-xxl-4 col-md-6 mb-3">
          <div class="card info-card customers-card">
            <div class="card-body">
              <h5 class="card-title">Member <span>| Cafe</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $totalMember }}</h6>
                  <span class="text-muted small pt-2 ps-1">Total Member</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Customers Card -->

</div>
       
        <div class="col-md-12">
          <div class="card top-selling overflow-auto">
            <div class="card-body pb-0">
              <h5 class="card-title">Menu <span>| Cafe 99</span></h5>

              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Gambar</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Harga</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($listMenu as $menu)
                  <tr>
                    <th scope="row"> 
                    @if($menu->gambar_produk)
                        <img src="{{ asset('storage/' . $menu->gambar_produk) }}" alt="Product Image" class="img-fluid" style="max-width: 150px; max-height: 150px;">
                    @else
                        <p>No image availadfble</p>
                    @endif
                    </th>
                    <td>{{ $menu->nama_produk }}</td>
                    <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

   
    </div><!-- End Left side columns -->

  </div>
</section>
@endsection

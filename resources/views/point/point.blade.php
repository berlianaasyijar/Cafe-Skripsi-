@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Point</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item">Point</li>
                <li class="breadcrumb-item active">Point</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- ======= Main ======= -->
    <section class="section">
    <!-- Level Display -->
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Level Anda</h5>
                    <!-- Display Current Level -->
                    <p class="text-center">Level Anda saat ini:</p>
                    @if ($points > 300)
                        <div class="text-center">
                            <img src="{{ asset('assets/img/Platinum (2).png') }}" alt="Level Platinum" class="img-fluid" width="100">
                            <p>Platinum - 400 Poin</p>
                            <span class="badge bg-danger">Potongan 40%</span>
                        </div>
                    @elseif ($points > 200)
                        <div class="text-center">
                            <img src="{{ asset('assets/img/Gold (2).png') }}" alt="Level Gold" class="img-fluid" width="100">
                            <p>Gold - 300 Poin</p>
                            <span class="badge bg-danger">Potongan 30%</span>
                        </div>
                    @elseif ($points > 100)
                        <div class="text-center">
                            <img src="{{ asset('assets/img/Silver (2).png') }}" alt="Level Silver" class="img-fluid" width="100">
                            <p>Silver - 200 Poin</p>
                            <span class="badge bg-danger">Potongan 20%</span>
                        </div>
                    @else
                        <div class="text-center">
                            <img src="{{ asset('assets/img/Bronze (2).png') }}" alt="Level Bronze" class="img-fluid" width="100">
                            <p>Bronze - 100 Poin</p>
                            <span class="badge bg-danger">Potongan 10%</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Bar -->
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Point Anda</h5>
                    @if ($points <= 400)
                        <p>{{ $points }} Point - Kumpulkan {{ $pointsRequired }} Point untuk mencapai level berikutnya!</p>
                    @endif

                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%;" aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">{{ $progressPercentage }}%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reward Section -->
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Voucher Reward</h5>
                    <p>Tukarkan poinmu untuk mendapatkan voucher potongan harga tersebut!</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Bronze -->
                        <div class="p-3 text-center">
                            <img src="{{ asset('assets/img/Bronze (2).png') }}" alt="Level Bronze" class="img-fluid" width="80">
                            <p>Level Bronze - 100 Poin</p>
                            <span class="badge bg-danger">Potongan 10%</span>
                        </div>
                        <!-- Silver -->
                        <div class="p-3 text-center">
                            <img src="{{ asset('assets/img/Silver (2).png') }}" alt="Level Silver" class="img-fluid" width="80">
                            <p>Level Silver - 200 Poin</p>
                            <span class="badge bg-danger">Potongan 20%</span>
                        </div>
                        <!-- Gold -->
                        <div class="p-3 text-center">
                            <img src="{{ asset('assets/img/Gold (2).png') }}" alt="Level Gold" class="img-fluid" width="80">
                            <p>Level Gold - 300 Poin</p>
                            <span class="badge bg-danger">Potongan 30%</span>
                        </div>
                        <!-- Platinum -->
                        <div class="p-3 text-center">
                            <img src="{{ asset('assets/img/Platinum (2).png') }}" alt="Level Platinum" class="img-fluid" width="80">
                            <p>Level Platinum - 400 Poin</p>
                            <span class="badge bg-danger">Potongan 40%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

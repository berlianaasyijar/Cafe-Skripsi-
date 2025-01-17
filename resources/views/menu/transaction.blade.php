@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Transaksi Pemesanan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Member</li>
            <li class="breadcrumb-item active">Data Member</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<!-- Section for Transaction -->
<section class="section" id="transactionSection" style="display: block;">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title">Transaksi</h2>

                        @if(isset($member))
                            <p>Poin Anda: <strong>{{ $member->point }}</strong></p>
                        @else
                            <p>Poin Anda: <strong>0</strong></p>
                        @endif

                        <!-- Dropdown untuk penukaran poin -->
                        <div class="mb-3">
                            <label for="redeemPoints">Tukar Poin:</label>
                            <select id="redeemPoints" class="form-select">
                                <option value="0" data-discount="0">
                                    @if(!empty($redeemableLevels))
                                        Tidak Menukar Poin
                                    @else
                                        Poin tidak mencukupi
                                    @endif
                                </option>
                                @if(!empty($redeemableLevels))
                                    @foreach($redeemableLevels as $level => $discount)
                                        <option value="{{ $level }}" data-discount="{{ $discount }}">
                                            {{ $level == 'Bronze' ? '100 Point' : ($level == 'Silver' ? '200 Point' : ($level == 'Gold' ? '300 Point' : '400 Point')) }} - Potongan {{ $discount }}%
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Table for Transaction -->
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="transactionTable"></tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Total Biaya: <span id="totalPrice">Rp 0</span></h3>
                            <button id="orderButton" class="btn btn-primary">Pesan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section for Payment -->
<section class="section" id="paymentSection" style="display: none;">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h4>Scan QRIS</h4>
                        <img src="{{ asset('assets/img/qris.png') }}" alt="QRIS" class="img-fluid" style="max-width: 250px;">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4>Upload Bukti Pembayaran</h4>
                        <form id="paymentForm" enctype="multipart/form-data" method="POST" action="{{ route('submitPayment') }}">
                            @csrf
                            <input type="hidden" name="total_price" id="hiddenTotalPrice">
                            <input type="hidden" name="cart" id="cartInput">
                            <input type="hidden" name="redeem_level" id="redeemLevelInput">

                            <div class="mb-3">
                                <input type="file" class="form-control" name="payment_proof" required>
                            </div>
                            <button type="submit" class="btn btn-success">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button id="backButton" class="btn btn-secondary">Kembali</button>
        </div>
    </div>
</section>

<script>
document.getElementById('redeemPoints').addEventListener('change', function () {
    const discount = parseInt(this.options[this.selectedIndex].dataset.discount || 0);
    const totalPriceElement = document.getElementById('totalPrice');
    const hiddenTotalPrice = document.getElementById('hiddenTotalPrice');

    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    let originalTotal = 0;
    cart.forEach(item => {
        originalTotal += item.price * item.quantity;
    });

    const discountedTotal = originalTotal - (originalTotal * discount / 100);
    totalPriceElement.textContent = `Rp ${discountedTotal.toLocaleString('id-ID')}`;
    hiddenTotalPrice.value = discountedTotal;
    document.getElementById('redeemLevelInput').value = this.value;
});

document.getElementById('paymentForm').addEventListener('submit', () => {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    document.getElementById('cartInput').value = JSON.stringify(cart);

    // Kosongkan localStorage setelah form di-submit
    localStorage.removeItem('cart');
});

document.addEventListener('DOMContentLoaded', () => {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const transactionTable = document.getElementById('transactionTable');
    const totalPrice = document.getElementById('totalPrice');
    const hiddenTotalPrice = document.getElementById('hiddenTotalPrice');

    const updateCart = () => {
        transactionTable.innerHTML = '';
        let total = 0;

        cart.forEach((item, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.name}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-outline-secondary btn-sm me-2" onclick="decrementQuantity(${index})">-</button>
                        ${item.quantity}
                        <button class="btn btn-outline-secondary btn-sm ms-2" onclick="incrementQuantity(${index})">+</button>
                    </div>
                </td>
                <td>Rp ${parseInt(item.price).toLocaleString()}</td>
                <td>Rp ${(item.price * item.quantity).toLocaleString()}</td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="removeItem(${index})">Hapus</button>
                </td>
            `;
            transactionTable.appendChild(row);

            total += item.price * item.quantity;
        });

        totalPrice.innerText = `Rp ${total.toLocaleString()}`;
        hiddenTotalPrice.value = total;
        localStorage.setItem('cart', JSON.stringify(cart));
    };

    window.decrementQuantity = (index) => {
        if (cart[index].quantity > 1) {
            cart[index].quantity -= 1;
            updateCart();
        }
    };

    window.incrementQuantity = (index) => {
        cart[index].quantity += 1;
        updateCart();
    };

    window.removeItem = (index) => {
        cart.splice(index, 1);
        updateCart();
    };

    document.getElementById('orderButton').addEventListener('click', () => {
        if (cart.length === 0) {
            alert('Keranjang kosong. Tambahkan produk terlebih dahulu.');
            return;
        }
        document.getElementById('transactionSection').style.display = 'none';
        document.getElementById('paymentSection').style.display = 'block';
    });

    document.getElementById('backButton').addEventListener('click', () => {
        document.getElementById('transactionSection').style.display = 'block';
        document.getElementById('paymentSection').style.display = 'none';
    });

    updateCart();
});
</script>
@endsection

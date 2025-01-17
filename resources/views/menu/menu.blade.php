@extends('layouts.app')
@section('content')
<style>
  .form-select {
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ddd;
    background-color: white;
}

.small-card-img {
    height: 200px;
    object-fit: cover;
}
</style>
    <div class="pagetitle">
        <h1>Menu Cafe 99</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Menu</li>
                <li class="breadcrumb-item active" id="active-category">Semua Menu</li>
            </ol>
        </nav>
    </div>
    <div class="mb-4">
    <select class="form-select" id="categoryFilter" style="width: 200px;">
        <option value="all">Semua Menu</option>
        <option value="Makanan">Makanan</option>
        <option value="Minuman">Minuman</option>
        <option value="Camilan">Camilan</option>
    </select>
</div>

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Detail Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productForm">
                    <input type="hidden" id="productId" name="productId">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nama Produk</label>
                        <input type="text" id="productName" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="productQuantity" class="form-label">Jumlah</label>
                        <div class="input-group">
                            <button type="button" id="decrementButton" class="btn btn-outline-secondary">-</button>
                            <input type="number" id="productQuantity" class="form-control text-center" value="1" readonly>
                            <button type="button" id="incrementButton" class="btn btn-outline-secondary">+</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="addToCartButton" class="btn btn-primary">Tambah ke Keranjang</button>
            </div>
        </div>
    </div>
</div>

<!-- Daftar Produk -->
<section class="section">
    <div class="row" id="productContainer">
    @foreach($products as $product)
<div class="col-lg-4 mb-4 product-card" 
     id="{{ $product->id }}" 
     data-id="{{ $product->id }}" 
     data-name="{{ $product->nama_produk }}" 
     data-price="{{ $product->harga }}" 
     data-category="{{ $product->kategori }}">
    <div class="card">
        @if($product->gambar_produk)
            <img src="{{ asset('storage/' . $product->gambar_produk) }}" alt="Product Image" class="img-fluid small-card-img">
        @else
            <p>No image available</p>
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $product->nama_produk }}</h5>
            <p class="card-description">{{ $product->deskripsi }}</p>
            <p class="card-text" style="color: rgb(167, 28, 28); font-weight: bold;">
                Rp {{ number_format($product->harga, 0, ',', '.') }}
            </p>
        </div>
    </div>
</div>
@endforeach

    </div>
</section>

<!-- Button Keranjang -->
<div class="cart-container" style="position: fixed; bottom: 20px; right: 20px;">
    <button id="cartButton" class="btn btn-primary">
        <i class="bi bi-cart"></i> Keranjang (<span id="cartCount">0</span>)
    </button>
</div>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const categoryFilter = document.getElementById('categoryFilter');
    const productCards = document.querySelectorAll('.product-card');

    // Filter produk berdasarkan kategori
    categoryFilter.addEventListener('change', function() {
        const selectedCategory = this.value.toLowerCase(); // Case insensitive

        productCards.forEach(card => {
            const productCategory = card.dataset.category.toLowerCase(); // Normalize category value

            if (selectedCategory === 'all' || productCategory === selectedCategory) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });

        // Perbarui nama kategori aktif
        const activeCategory = document.getElementById('active-category');
        activeCategory.textContent = selectedCategory === 'all' ? 'Semua Menu' : this.options[this.selectedIndex].text;
    });
    const productModal = new bootstrap.Modal(document.getElementById("productModal"));
    const cartButton = document.getElementById("cartButton");

    let selectedProduct = {};
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    // Update cart count
    const updateCartCount = () => {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        document.getElementById("cartCount").innerText = totalItems;
    };

    updateCartCount();

    // Open modal on product click
    productCards.forEach(card => {
        card.addEventListener("click", () => {
            selectedProduct = {
                id: card.dataset.id,
                name: card.dataset.name,
                price: card.dataset.price,
            };

            document.getElementById("productId").value = selectedProduct.id;
            document.getElementById("productName").value = selectedProduct.name;
            document.getElementById("productQuantity").value = 1;

            productModal.show();
        });
    });

    // Increment/Decrement quantity
    document.getElementById("incrementButton").addEventListener("click", () => {
        const quantityInput = document.getElementById("productQuantity");
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });

    document.getElementById("decrementButton").addEventListener("click", () => {
        const quantityInput = document.getElementById("productQuantity");
        if (quantityInput.value > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    });

    // Add to cart
    document.getElementById("addToCartButton").addEventListener("click", () => {
        const quantity = parseInt(document.getElementById("productQuantity").value);
        const existingProduct = cart.find(item => item.id === selectedProduct.id);

        if (existingProduct) {
            existingProduct.quantity += quantity;
        } else {
            cart.push({ ...selectedProduct, quantity });
        }

        localStorage.setItem("cart", JSON.stringify(cart));
        updateCartCount();
        productModal.hide();
    });

    // Navigate to transaction page
    cartButton.addEventListener("click", () => {
        window.location.href = "/transaction";
    });
});

// document.addEventListener('DOMContentLoaded', function() {
//     const categoryFilter = document.getElementById('categoryFilter');
//     const productCards = document.querySelectorAll('.product-card');

//     categoryFilter.addEventListener('change', function() {
//         const selectedCategory = this.value;
        
//         productCards.forEach(card => {
//             if (selectedCategory === 'all' || card.dataset.category === selectedCategory) {
//                 card.style.display = 'block';
//             } else {
//                 card.style.display = 'none';
//             }
//         });
//     });
// });
</script>
@endsection

@push('scripts')

@endpush
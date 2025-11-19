<div>

    {{-- ALERT CHECKOUT --}}
    @if (session()->has('checkout_success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('checkout_success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    {{-- ====================== --}}
    {{--      STYLE PREMIUM     --}}
    {{-- ====================== --}}
    <style>
        /* CARD PRODUCT */
        .product-card {
            background: #ffffff;
            border-radius: 28px;
            padding: 22px;
            box-shadow: 0px 8px 22px rgba(0,0,0,0.07);
            transition: 0.2s ease;
            text-align: center;
            cursor: pointer;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 12px 28px rgba(0,0,0,0.12);
        }

        .product-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
            border-radius: 22px;
            margin-bottom: 16px;
        }

        .product-brand {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #111;
        }

        .product-price {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 12px;
            color: #444;
        }

        .btn-show {
            background: #000;
            color: #fff;
            border-radius: 12px;
            padding: 8px 0;
            font-weight: 500;
        }
        .btn-show:hover {
            background: #333;
        }


        /* PAGINATION */
        .pagination .page-link {
            border: none;
            color: #111;
            font-weight: 600;
            background: transparent;
        }
        .pagination .page-link:hover {
            text-decoration: underline;
            background: transparent;
        }


        /* ========================== */
        /* PREMIUM CHECKOUT MODAL FIX */
        /* ========================== */

        .modal-premium .modal-content {
            background: #ffffff !important;
            border-radius: 30px !important;
            padding: 28px;
            border: none;
            box-shadow: 0px 10px 35px rgba(0,0,0,0.18);
        }

        .modal-premium .modal-header {
            border-bottom: none;
            text-align: center;
        }

        .modal-premium .modal-header h5 {
            font-weight: 700;
            font-size: 22px;
            margin: 0 auto;
        }

        .modal-premium img {
            border-radius: 22px;
            box-shadow: 0px 5px 20px rgba(0,0,0,0.15);
        }

        .modal-premium .price {
            font-size: 24px;
            font-weight: 800;
            color: #d90429;
        }

        .btn-checkout {
            background: #000;
            color: #fff;
            border-radius: 12px;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
        }
        .btn-checkout:hover {
            background: #333;
        }
    </style>
    {{-- LIST PRODUK --}}
    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="product-card">

                    {{-- GAMBAR PRODUK --}}
                    <img 
                        src="{{ $product->image 
                            ? asset('storage/products/'.$product->image)
                            : 'https://via.placeholder.com/300x250?text='.urlencode($product->name) }}"
                        class="product-image"
                        alt="{{ $product->name }}"
                    >

                    {{-- NAMA --}}
                    <div class="product-brand">{{ $product->name }}</div>

                    {{-- HARGA --}}
                    <div class="product-price">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>

                    {{-- BUTTON --}}
                    <button wire:click="selectProduct({{ $product->id }})" 
                        class="btn btn-show w-100">
                        Show
                    </button>

                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    Belum ada produk tersedia.
                </div>
            </div>
        @endforelse
    </div>



    {{-- PAGINATION STATIC (bisa diganti Livewire Pagination) --}}
    <div class="text-center mt-4">
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item disabled"><a class="page-link">Pages &lt;</a></li>
                <li class="page-item active"><a class="page-link">1</a></li>
                <li class="page-item"><a class="page-link">2</a></li>
                <li class="page-item"><a class="page-link">3</a></li>
                <li class="page-item"><a class="page-link">...</a></li>
                <li class="page-item"><a class="page-link">&gt;</a></li>
            </ul>
        </nav>
    </div>



    {{-- ============================ --}}
    {{--        PREMIUM MODAL         --}}
    {{-- ============================ --}}
    @if ($showCheckout && $selectedProduct)
        <div class="modal fade show modal-premium" tabindex="-1" style="display:block;" aria-modal="true" role="dialog">

            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    {{-- HEADER --}}
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Product & Checkout</h5>
                        <button type="button" class="btn-close" wire:click="closeCheckout"></button>
                    </div>

                    {{-- BODY --}}
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-5">
                                <img 
                                    src="{{ $selectedProduct->image
                                        ? asset('storage/products/'.$selectedProduct->image)
                                        : 'https://via.placeholder.com/400x400?text='.urlencode($selectedProduct->name) }}"
                                    class="img-fluid mb-3"
                                    alt="{{ $selectedProduct->name }}">
                            </div>

                            <div class="col-md-7">
                                <h4 class="fw-bold">{{ $selectedProduct->name }}</h4>
                                <p class="text-muted">{{ $selectedProduct->brand }}</p>

                                <p class="price mb-3">
                                    Rp {{ number_format($selectedProduct->price, 0, ',', '.') }}
                                </p>

                                <hr>

                                <h6 class="fw-bold mb-2">Form Checkout</h6>

                                <form wire:submit.prevent="submitCheckout">

                                    <div class="mb-2">
                                        <label class="form-label">Nama Lengkap *</label>
                                        <input type="text" class="form-control" wire:model="customer_name" required>
                                    </div>

                                    <div class="mb-2">
                                        <label class="form-label">Alamat Lengkap *</label>
                                        <textarea class="form-control" rows="3" wire:model="customer_address" required></textarea>
                                    </div>

                                    <div class="mb-2">
                                        <label class="form-label">Metode Pembayaran *</label>
                                        <select class="form-select" wire:model="payment_method">
                                            <option value="e-wallet">E-Wallet</option>
                                            <option value="transfer">Transfer Bank</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn-checkout w-100 mt-3">
                                        Checkout via WhatsApp
                                    </button>

                                </form>

                                <div class="text-center mt-3">
                                    <small class="text-muted">
                                        ⏱️ Waktu tersisa 
                                        <strong class="text-danger">{{ gmdate("i:s", $countdown) }}</strong>
                                    </small>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    @endif



    {{-- SCRIPT --}}
    @script
        <script>
            $wire.on('redirectToWhatsApp', (event) => {
                window.open(event.url, '_blank');
            });
        </script>
    @endscript

</div>
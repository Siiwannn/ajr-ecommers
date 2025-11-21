<div>
    <style>
        .product-card {
            color: #B2BEB5;
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
    </style>
    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="product-card">
                    <img
                        src="{{ $product->image
                            ? asset('storage/products/'.$product->image)
                            : 'https://via.placeholder.com/300x250?text='.urlencode($product->name) }}"
                        class="product-image"
                        alt="{{ $product->name }}"
                    >
                    <div class="product-brand">{{ $product->name }}</div>
                    <div class="product-price">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>
                    <a href="{{ route('product.detail', $product->id) }}" class="btn btn-show w-100">
                        Show
                    </a>
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
    <div class="text-center mt-4">
        {{ $products->links() }}
    </div>
</div>

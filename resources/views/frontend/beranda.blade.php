@extends('layouts.app')

@section('content')

<!-- HERO -->
<div class="hero-wrapper">
    <img src="{{ asset('/images/products/beranda.jpg') }}" alt="Hero" class="hero-image">

    <div class="search-bar-wrapper">
        <form action="{{ route('product') }}" method="GET" class="search-bar">
            <input type="text" name="search" placeholder="Search">
            <button type="submit" style="background:none;border:none;">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>
</div>

<!-- AJR TEXT -->
<div class="ajr-section">
    <h1>AJR <span>memiliki pengalaman luas dan reputasi substansial dalam industri retail model pakaian pria.</span></h1>  
</div>

<!-- PRODUCT PREVIEW -->
<div class="container mt-4 mb-5">

    <div class="row">

        @php
            $featured = \App\Models\Product::take(3)->get();
        @endphp

        @foreach($featured as $p)
        <div class="col-md-4 mb-4">
            <div class="product-card">
                <img src="{{ asset('storage/products/'.$p->image) }}"
                     alt="{{ $p->name }}"
                     onerror="this.src='https://via.placeholder.com/300x260'">

                <a href="{{ route('product') }}" class="detail-btn">DETAIL</a>
            </div>
        </div>
        @endforeach

    </div>

    <div class="show-more">
        <a href="{{ route('product') }}">SHOW MORE ↓</a>
    </div>

</div>

@endsection
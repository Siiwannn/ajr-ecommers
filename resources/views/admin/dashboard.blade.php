@extends('layouts.admin')

@section('content')
<h2>Dashboard</h2>
<p class="text-muted">Selamat datang, {{ auth()->user()->name }}!</p>

<div class="row mt-4">
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5>Total Produk</h5>
                <h2>{{ \App\Models\Product::count() }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection
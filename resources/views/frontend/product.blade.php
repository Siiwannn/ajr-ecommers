@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div style="background: #f8f9fa; padding: 40px 0; margin-bottom: 40px;">
    <div class="container">
        <h1 class="fw-bold mb-2">Products</h1>
    </div>
</div>

<!-- Products List -->
<div class="container mb-5">
    @livewire('product-list')
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Contact Us</h1>
    
    <p>Hubungi kami dengan mudah dan pelayanan cepat.</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body text-center">
                    <i class="bi bi-telephone fs-1 text-danger"></i>
                    <h5 class="mt-3">Telepon</h5>
                    <p>(021) 4587 7615</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body text-center">
                    <i class="bi bi-whatsapp fs-1 text-success"></i>
                    <h5 class="mt-3">Whatsapp</h5>
                    <p>0811 8883 465</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body text-center">
                    <i class="bi bi-envelope fs-1 text-primary"></i>
                    <h5 class="mt-3">Email</h5>
                    <p>CS @anugrahjayaretailindo.co.id</p>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mt-5 mb-3">Pesan</h3>
    <form>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">No. HP</label>
            <input type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Perusahaan</label>
            <input type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Pesan</label>
            <textarea class="form-control" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-danger">Kirim</button>
    </form>

    <div class="mt-5">
        <h5>Alamat:</h5>
        <p>Ruko Graha SKG No. GN 07, Jl. Raya Kelapa Nias, Kelapa Gading Barat, Jakarta Utara, DKI Jakarta 14240</p>
    </div>
</div>
@endsection
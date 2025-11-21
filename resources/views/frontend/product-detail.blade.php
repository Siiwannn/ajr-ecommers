@extends('layouts.app')

@section('content')
<style>
.detail-box {
    background: #efefef;
    border-radius: 30px;
    padding: 35px;
}
    background: #9e9e9e;
    color: #fff;
    font-size: 20px;
    font-weight: bold;
    padding: 15px 45px;
    border-radius: 40px;
    border: none;
}
.buy-btn:hover {
    background: #7d7d7d;
}
</style>
<div class="container my-5">
    <h2 class="fw-bold mb-4">Detail Product</h2>
    <div class="detail-box">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="{{ $product->image ? asset('storage/products/'.$product->image)
                    : 'https://via.placeholder.com/300x300' }}"
                    class="img-fluid rounded mb-3"
                    style="border-radius: 25px;">
            </div>
            <div class="col-md-8">
                <p><strong>Brand</strong> : {{ $product->brand }}</p>
                <p><strong>Nama</strong> : {{ $product->name }}</p>
                <p><strong>Kategori</strong> : {{ $product->category ?? '-' }}</p>
                <p><strong>Deskripsi</strong> : {{ $product->description }}</p>
                <br>
                <h5>Ukuran:</h5>
                <p>M = LD 100cm &nbsp; PB 65cm</p>
                <p>L = LD 110cm &nbsp; PB 70cm</p>
                <p>XL = LD 112cm &nbsp; PB 72cm</p>
                <br>
                <h3 class="fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
                <button class="buy-btn mt-3" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                    BUY NOW
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ====================== CHECKOUT MODAL ====================== --}}
<div class="modal fade" id="checkoutModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-4" style="border-radius: 25px;">
            <div class="modal-header border-0">
                <h4 class="fw-bold mx-auto">Checkout Product</h4>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img src="{{ $product->image ? asset('storage/products/'.$product->image)
                        : 'https://via.placeholder.com/300x300' }}"
                        class="img-fluid rounded" style="max-height: 220px;">
                </div>
                <h5 class="fw-bold text-center">{{ $product->name }}</h5>
                <p class="text-muted text-center">{{ $product->brand }}</p>
                <h4 class="text-center fw-bold text-danger">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </h4>
                <hr>
                <form>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Nama anda...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat Lengkap</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Metode Pembayaran</label>
                        <select class="form-select" id="payment-method" onchange="toggleEwalletInfo()">
                            <option value="ewallet">E-Wallet</option>
                            <option value="transfer">Transfer Bank</option>
                        </select>
                    </div>
                    <div id="ewallet-info" style="display:none;">
                        <label class="form-label fw-bold">Pilih E-Wallet:</label>
                        <div class="d-flex align-items-center mb-2">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Logo_dana_blue.svg" alt="Dana" style="height:32px;width:32px;margin-right:8px;">
                            <span class="fw-bold">Dana</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2b/Logo_ovo_purple.svg" alt="OVO" style="height:32px;width:32px;margin-right:8px;">
                            <span class="fw-bold">OVO</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/GoPay_logo.svg" alt="GoPay" style="height:32px;width:32px;margin-right:8px;">
                            <span class="fw-bold">GoPay</span>
                        </div>
                        <div class="mb-2">
                            <span class="fw-bold">Nomor E-Wallet: </span>
                            <span class="text-primary">082113668196</span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-dark w-100 py-3 fw-bold" id="checkoutBtn" onclick="openPaymentPopup()" disabled>
    Checkout via WhatsApp
</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ====================== PAYMENT POPUP MODAL ====================== --}}
<div class="modal fade" id="paymentPopup" tabindex="-1" aria-labelledby="paymentPopupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4 text-center" style="border-radius: 25px;">
            <div id="loadingSpinner" style="margin-bottom: 20px;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <h5 class="fw-bold mb-3 text-danger">Selesaikan pembayaran dalam 10 menit!</h5>
            <div class="mb-2">
                <span class="fw-bold">Nomor E-Wallet: </span>
                <span class="text-primary">082113668196</span>
            </div>
            <div class="d-flex justify-content-center mb-3" style="gap:16px;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" alt="Dana" style="height:32px;width:32px;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg" alt="OVO" style="height:32px;width:32px;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/GoPay_logo.svg" alt="GoPay" style="height:32px;width:32px;">
            </div>
            <div class="mb-3">
                <span class="fw-bold">Waktu tersisa: </span>
                <span id="countdown" class="text-danger" style="font-size:1.2em;">10:00</span>
            </div>
            <a id="wa-btn" href="#" target="_blank" class="btn btn-success w-100 py-2 fw-bold mb-2" onclick="sendWaProof()">
                Kirim Bukti Pembayaran via WhatsApp
            </a>
            <button type="button" class="btn btn-secondary w-100 py-2" data-bs-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>

<script>
// Validasi input form checkout modal pertama
function validateCheckoutForm() {
    var name = document.querySelector('input[placeholder="Nama anda..."]').value.trim();
    var address = document.querySelector('textarea').value.trim();
    var method = document.getElementById('payment-method').value;
    var btn = document.getElementById('checkoutBtn');
    if (name.length > 0 && address.length > 0 && method.length > 0) {
        btn.removeAttribute('disabled');
    } else {
        btn.setAttribute('disabled', true);
    }
}
// Event listener untuk input
window.addEventListener('DOMContentLoaded', function() {
    document.querySelector('input[placeholder="Nama anda..."]').addEventListener('input', validateCheckoutForm);
    document.querySelector('textarea').addEventListener('input', validateCheckoutForm);
    document.getElementById('payment-method').addEventListener('change', validateCheckoutForm);
    validateCheckoutForm();
});

document.getElementById('paymentPopup').addEventListener('hidden.bs.modal', function () {
    document.body.classList.remove('modal-open');
    document.querySelectorAll('.modal-backdrop').forEach(function(el) { el.remove(); });
});

function openPaymentPopup() {
    // Tutup modal pertama (checkoutModal)
    var checkoutModalEl = document.getElementById('checkoutModal');
    if (checkoutModalEl && typeof bootstrap !== 'undefined') {
        var checkoutModal = bootstrap.Modal.getInstance(checkoutModalEl);
        if (checkoutModal) checkoutModal.hide();
    }
    // Buka modal kedua (paymentPopup)
    var paymentPopupEl = document.getElementById('paymentPopup');
    if (paymentPopupEl && typeof bootstrap !== 'undefined') {
        var paymentPopup = bootstrap.Modal.getOrCreateInstance(paymentPopupEl);
        paymentPopup.show();
        startCountdown(10*60);
    } else {
        alert('Bootstrap modal tidak ditemukan. Pastikan Bootstrap JS sudah di-load.');
    }
}
var countdownInterval;
function startCountdown(seconds) {
    clearInterval(countdownInterval);
    var display = document.getElementById('countdown');
    var time = seconds;
    function updateCountdown() {
        var min = Math.floor(time/60);
        var sec = time%60;
        display.textContent = (min<10?"0":"")+min+":"+(sec<10?"0":"")+sec;
        if(time>0) time--;
        else clearInterval(countdownInterval);
    }
    updateCountdown();
    countdownInterval = setInterval(updateCountdown, 1000);
}
function sendWaProof() {
    var name = document.querySelector('input[placeholder="Nama anda..."]')?.value || '';
    var address = document.querySelector('textarea')?.value || '';
    var method = document.getElementById('payment-method')?.value || '';
    var product = "{{ $product->name }}";
    var price = "{{ number_format($product->price, 0, ',', '.') }}";
    var waNumber = "6282113668196";
    var message = `Halo, saya sudah transfer pembayaran produk.\n\nNama: ${name}\nAlamat: ${address}\nProduk: ${product}\nHarga: Rp ${price}\nMetode: ${method}`;
    var waUrl = `https://wa.me/${waNumber}?text=${encodeURIComponent(message)}`;
    document.getElementById('wa-btn').setAttribute('href', waUrl);
}
function toggleEwalletInfo() {
    var method = document.getElementById('payment-method').value;
    document.getElementById('ewallet-info').style.display = (method === 'ewallet') ? 'block' : 'none';
}
window.addEventListener('DOMContentLoaded', function() {
    toggleEwalletInfo();
});
</script>
@endsection

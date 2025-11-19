<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductList extends Component
{
    public $selectedProduct = null;
    public $showCheckout = false;

    // Checkout form
    public $customer_name;
    public $customer_address;
    public $payment_method = 'e-wallet';
    public $countdown = 600; // 10 menit dalam detik

    public function selectProduct($productId)
    {
        $this->selectedProduct = Product::find($productId);
        $this->showCheckout = true;
        $this->countdown = 600; // Reset countdown
    }

    public function closeCheckout()
    {
        $this->showCheckout = false;
        $this->reset(['customer_name', 'customer_address', 'payment_method', 'selectedProduct']);
    }

    public function submitCheckout()
    {
        $this->validate([
            'customer_name' => 'required|min:3',
            'customer_address' => 'required|min:10',
            'payment_method' => 'required',
        ]);

        // Buat pesan WhatsApp
        $message = "🛍️ *PESANAN BARU*\n\n";
        $message .= "Nama: {$this->customer_name}\n";
        $message .= "Alamat: {$this->customer_address}\n\n";
        $message .= "📦 *Produk:*\n";
        $message .= "- {$this->selectedProduct->name}\n";
        $message .= "- Rp " . number_format($this->selectedProduct->price, 0, ',', '.') . "\n\n";
        $message .= "💳 Metode Pembayaran: " . ucfirst($this->payment_method) . "\n\n";
        $message .= "Silakan transfer dan kirim bukti pembayaran.";

        $whatsappNumber = '6281188883465'; // Ganti dengan nomor WA yang sesuai
        $whatsappUrl = "https://wa.me/{$whatsappNumber}?text=" . urlencode($message);

        session()->flash('checkout_success', 'Pesanan berhasil! Silakan lanjutkan pembayaran via WhatsApp.');
        
        $this->dispatch('redirectToWhatsApp', url: $whatsappUrl);
        $this->closeCheckout();
    }

    public function render()
    {
        $products = Product::latest()->get();
        return view('livewire.product-list', compact('products'));
    }
}
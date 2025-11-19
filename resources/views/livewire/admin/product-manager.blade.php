<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Form Add/Edit Product -->
    <div class="card mb-4">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">{{ $isEdit ? 'Edit Produk' : 'Tambah Produk Baru' }}</h5>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Produk *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga (Rp) *</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" wire:model="price">
                        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Brand</label>
                        <input type="text" class="form-control @error('brand') is-invalid @enderror" wire:model="brand">
                        @error('brand') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" class="form-control @error('category') is-invalid @enderror" wire:model="category">
                        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" wire:model="description" rows="3"></textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gambar Produk</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" wire:model="image" accept="image/*">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        
                        @if ($image)
                            <div class="mt-2">
                                <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" width="150">
                            </div>
                        @elseif ($old_image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/products/' . $old_image) }}" class="img-thumbnail" width="150">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-3">
                    @if ($isEdit)
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update Produk
                        </button>
                        <button type="button" class="btn btn-secondary" wire:click="resetForm">
                            <i class="bi bi-x-circle"></i> Batal
                        </button>
                    @else
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Tambah Produk
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Table Products -->
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Daftar Produk ({{ $products->count() }})</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="80">Gambar</th>
                            <th>Brand</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>
                                    @if ($product->image)
                                        <img src="{{ asset('storage/products/' . $product->image) }}" 
                                             class="img-thumbnail" width="60" 
                                             onerror="this.src='https://via.placeholder.com/60x60?text=No+Image'">
                                    @else
                                        <img src="https://via.placeholder.com/60x60?text=No+Image" class="img-thumbnail" width="60">
                                    @endif
                                </td>
                                <td>{{ $product->brand ?? '-' }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category ?? '-' }}</td>
                                <td class="fw-bold text-danger">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>
                                    <button wire:click="edit({{ $product->id }})" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button wire:click="delete({{ $product->id }})" 
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada produk</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PT Anugrah Jaya Retainindo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
    <style>
        .admin-header {
            background: #dc3545;
            color: white;
            padding: 15px 0;
        }
        .admin-sidebar {
            background: #f8f9fa;
            min-height: calc(100vh - 70px);
            padding: 20px;
        }
        .admin-content {
            padding: 30px;
        }
    </style>
</head>
<body>
    <!-- Admin Header -->
    <div class="admin-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('logo.png') }}" alt="Logo" height="40" onerror="this.src='https://via.placeholder.com/40x40?text=AJR'">
                        <span class="fw-bold">PT. ANUGRAH JAYA RETAININDO - Admin</span>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <span class="me-3">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-light btn-sm">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 admin-sidebar">
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.products') ? 'active' : '' }}" href="{{ route('admin.products') }}">
                        <i class="bi bi-box-seam"></i> Products
                    </a>
                    <a class="nav-link" href="{{ route('home') }}" target="_blank">
                        <i class="bi bi-eye"></i> View Website
                    </a>
                </nav>
            </div>

            <!-- Content -->
            <div class="col-md-10 admin-content">
                @yield('content')
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>
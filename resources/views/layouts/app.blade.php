<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Anugrah Jaya Retailindo</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @livewireStyles

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #fff; }

        /* ---------------- Header ---------------- */
        .header-bar {
            background: #fff;
            padding: 20px 0;
            border-bottom: 1px solid #ddd;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-links a {
            color: #000;
            margin-left: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            position: relative;
        }

        .company-link {
            display: flex;
            align-items: center;
            color: #000;
        }      

        .company-link:hover {
            color: #000; /* biar tidak ikut berubah warna */
        }

        .company-text {
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .nav-links a::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 2px;
            background: #000;
            bottom: -5px;
            left: 0;
            transform: scaleX(0);
            transition: 0.2s;
        }

        .nav-links a:hover::after,
        .nav-links a.active::after {
            transform: scaleX(1);
        }

        /* ---------------- HERO SECTION ---------------- */
        .hero-wrapper {
            width: 100%;
            height: 300px;
            position: relative;
            background: linear-gradient(90deg, #492308, #cf6112);
            overflow: hidden;
        }

        .hero-image {
            position: absolute;
            top: -20%; /* geser gambar ke atas supaya atasnya ter-crop */
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            height: auto; 
            object-fit: cover;
            object-position: center top;
        }

        .search-bar-wrapper {
            position: absolute;
            bottom: 50px;
            left: 50%;
            transform: translateX(-50%);
            width: 380px;
        }

        .search-bar {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(3px);
            padding: 8px 18px;
            border-radius: 2px;
            display: flex;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .search-bar input {
            border: none;
            background: none;
            flex: 1;
            outline: none;
            font-size: 1rem;
        }

        /* ---------------- TEXT AJR SECTION ---------------- */
        .ajr-section {
            text-align: left;
            padding: 50px 20px 20px;
        }

        .ajr-section h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 700;
        }

        .ajr-section span {
            margin-top: 10px;
            font-size: 1rem;
        }

        /* ---------------- PRODUCT CARDS ---------------- */
        .product-card {
            background: #f4f4f4;
            padding: 0;
            border-radius: 20px;
            overflow: hidden;
            transition: 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .product-card img {
            width: 100%;
            height: 260px;
            object-fit: cover;
        }

        .detail-btn {
            display: block;
            text-align: center;
            padding: 12px 0;
            font-weight: 700;
            font-size: 1rem;
            text-decoration: underline;
            text-transform: uppercase;
            color: #000;
        }

        /* ---------------- Show More ---------------- */
        .show-more {
            text-align: center;
            margin-top: 20px;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .show-more a {
            text-decoration: none;
            color: #000;
        }

        /* ---------------- Footer ---------------- */
        footer {
            background: #797575;
            color: #fff;
            padding: 10px 0 5px;
            margin-top: 10px;
        }

        .header-inner {
            padding-left: 25px;
            padding-right: 25px;
        }


    </style>

</head>
<body>

  <!-- Header -->
  <div class="header-bar">
    <div class="container-fluid header-inner d-flex justify-content-between align-items-center">

        <a href="{{ route('home') }}" class="company-link text-decoration-none">
            <img src="{{ asset('/assets/logo.png') }}" alt="Logo" width="45" class="me-2">
            <strong class="company-text">PT. ANUGRAH JAYA RETAILINDO</strong>
        </a>

        <div class="nav-links d-flex align-items-center ms-auto">
            <a href="{{ route('product') }}" class="{{ request()->routeIs('product') ? 'active' : '' }}">Product</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us</a>
        </div>

    </div>
</div>

    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>© 2025 – PT. Anugrah Jaya Retailindo</p>
        </div>
    </footer>

</body>
</html>
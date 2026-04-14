<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'System Management')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --navy-primary: #0a2540;
            --navy-hover: #153b61;
            --bg-light: #f4f7f6;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Segoe UI', system-ui, sans-serif;
            overflow-x: hidden; /* Cegah scroll horizontal yang bocor */
        }

        /* LOGIKA DESKTOP (Layar > 768px) */
        @media (min-width: 768px) {
            .sidebar-wrapper {
                position: fixed; /* Sidebar dipaku di kiri layar */
                top: 0;
                left: 0;
                bottom: 0;
                width: 260px;
                background-color: var(--navy-primary);
                color: white;
                z-index: 1040;
                box-shadow: 2px 0 10px rgba(0,0,0,0.1);
                overflow-y: auto;
            }
            /* Sidebar Wrapper */
            .sidebar-wrapper {
                background-color: var(--navy-primary) !important;
                color: rgba(255, 255, 255, 0.8); /* Teks putih agak transparan */
            }

            /* Pastikan semua link di dalam sidebar berwarna putih */
            .sidebar-wrapper a {
                color: rgba(255, 255, 255, 0.9) !important;
                text-decoration: none;
            }

            .sidebar-wrapper a:hover {
                color: var(--accent-blue) !important;
                background-color: var(--navy-hover);
            }

            /* Override Offcanvas Default */
            .offcanvas-md {
                border-right: none !important;
            }

            .content-wrapper {
                margin-left: 260px; /* Konten utama digeser ke kanan menghindari sidebar */
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }
        }

        /* LOGIKA MOBILE (Layar < 768px) */
        @media (max-width: 767.98px) {
            .content-wrapper {
                width: 100%;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }
            .sidebar-wrapper {
                background-color: var(--navy-primary); /* Warna untuk mode Offcanvas */
                color: white;
            }
        }

        main {
            flex-grow: 1;
            padding: 1.5rem; /* Sedikit dikecilkan agar di HP tidak terlalu sempit */
        }

        @media (min-width: 768px) {
            main {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-light bg-white border-bottom d-md-none px-3 shadow-sm sticky-top">
    <a class="navbar-brand fw-bold" href="#" style="color: var(--navy-primary);">LogiSync WMS</a>

    <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<aside class="sidebar-wrapper offcanvas-md offcanvas-start" tabindex="-1" id="sidebarMenu">
    <div class="offcanvas-header d-md-none bg-white">
        <h5 class="offcanvas-title fw-bold" style="color: var(--navy-primary);">Menu Navigasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column p-0">
        @include('partials.sidebar')
    </div>
</aside>

<div class="content-wrapper">

    <div class="d-none d-md-block">
        @include('partials.navbar')
    </div>

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'System Management')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        /* Definisi Tone Warna Biru Dongker */
        :root {
            --navy-primary: #0a2540;   /* Biru dongker gelap */
            --navy-hover: #153b61;     /* Biru dongker terang untuk hover */
            --bg-light: #f4f7f6;       /* Abu-abu sangat terang untuk background konten */
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        /* Arsitektur Layout Utama */
        .wrapper {
            display: flex;
            height: 100vh; /* KUNCI 1: Kunci tinggi aplikasi pas selayar monitor */
            overflow: hidden; /* KUNCI 2: Matikan scrollbar utama browser */
        }

        .sidebar-wrapper {
            width: 260px;
            background-color: var(--navy-primary);
            color: white;
            flex-shrink: 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            height: 100vh;
            overflow-y: auto; /* Opsional: Jaga-jaga jika besok menumu tambah banyak sampai ke bawah layar */
        }

        /* Area Sebelah Kanan (Nav, Konten, Footer) */
        .content-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            height: 100vh;
            overflow-y: auto; /* KUNCI 3: Beri izin scroll hanya di kotak kanan ini */
            background-color: var(--bg-light); /* Pindahkan background body ke sini */
        }

        main {
            flex-grow: 1;
            padding: 2rem;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <aside class="sidebar-wrapper">
        @include('partials.sidebar')
    </aside>

    <div class="content-wrapper">

        @include('partials.navbar')

        <main>
            @yield('content')
        </main>

        @include('partials.footer')

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

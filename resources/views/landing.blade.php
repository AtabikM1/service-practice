<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockOps | Presisi Inventaris dalam Satu Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy-primary: #0a2540;
            --navy-hover: #153b61;
            --accent-blue: #00d4ff; /* Warna neon biru untuk aksen */
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #333;
            overflow-x: hidden;
        }

        /* Hero Section (Wajib Mencolok) */
        .hero-section {
            background: linear-gradient(135deg, var(--navy-primary) 0%, #1a1a2e 100%);
            color: white;
            padding: 120px 0 80px;
            min-height: 90vh; /* Agar layar depan hampir penuh */
            display: flex;
            align-items: center;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -1px;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            font-weight: 300;
            opacity: 0.9;
        }

        /* Tombol Call to Action */
        .btn-accent {
            background-color: var(--accent-blue);
            color: var(--navy-primary);
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-accent:hover {
            background-color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 212, 255, 0.3);
        }

        /* Utilities */
        .text-navy { color: var(--navy-primary); }
        .bg-light-gray { background-color: #f8f9fa; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: rgba(10, 37, 64, 0.95); backdrop-filter: blur(10px);">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-box-seam text-info me-2"></i>StockOps
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item dropdown position-static">
                    <a class="nav-link dropdown-toggle px-3" href="#" id="featuresDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Fitur Utama
                    </a>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-4 mt-2" aria-labelledby="featuresDropdown" style="min-width: 500px; background-color: rgba(255,255,255,0.98); backdrop-filter: blur(10px);">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3 text-primary">
                                        <i class="bi bi-clock-history fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1 text-dark">Audit Trail Real-time</h6>
                                        <p class="small text-muted mb-0">Rekam jejak setiap barang masuk & keluar dengan presisi kronologis absolut.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3 text-success">
                                        <i class="bi bi-ui-radios fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1 text-dark">UI/UX Interaktif</h6>
                                        <p class="small text-muted mb-0">Desain Mobile-First berbasis Card & Modal untuk operasi gudang yang cepat.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3 text-warning">
                                        <i class="bi bi-exclamation-triangle fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1 text-dark">Notifikasi Kritis</h6>
                                        <p class="small text-muted mb-0">Indikator visual otomatis untuk stok barang yang mendekati batas minimum.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="bg-info bg-opacity-10 p-3 rounded-3 me-3 text-info">
                                        <i class="bi bi-graph-up fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1 text-dark">Dashboard Analitik</h6>
                                        <p class="small text-muted mb-0">Ringkasan KPI gudang (Total SKU & Kuantitas Fisik) dalam satu layar.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3" href="#" id="techDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Teknologi
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow rounded-4 mt-2 p-2" aria-labelledby="techDropdown" style="min-width: 250px;">
                        <li>
                            <div class="dropdown-item py-2 d-flex align-items-center rounded-3">
                                <i class="bi bi-database-lock text-danger me-3 fs-5"></i>
                                <div>
                                    <span class="d-block fw-bold text-dark">Anti Race-Condition</span>
                                    <small class="text-muted text-wrap">Database InnoDB dengan fitur Lock For Update.</small>
                                </div>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <div class="dropdown-item py-2 d-flex align-items-center rounded-3">
                                <i class="bi bi-diagram-3 text-primary me-3 fs-5"></i>
                                <div>
                                    <span class="d-block fw-bold text-dark">Service Pattern</span>
                                    <small class="text-muted text-wrap">Pemisahan logika bisnis murni dari Controller.</small>
                                </div>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <div class="dropdown-item py-2 d-flex align-items-center rounded-3">
                                <i class="bi bi-server text-success me-3 fs-5"></i>
                                <div>
                                    <span class="d-block fw-bold text-dark">Cloud Deployment</span>
                                    <small class="text-muted text-wrap">Berjalan di Nginx (VPS) dengan Sertifikat SSL.</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>

                <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                    <a class="btn btn-outline-light btn-sm rounded-pill px-4" href="{{ route('login') }}">Masuk Sistem</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 pe-lg-5">
                <span class="badge bg-info text-dark mb-3 px-3 py-2 rounded-pill fw-bold">WMS Version 1.0</span>
                <h1 class="hero-title mb-4">Digitalisasi Manajemen Stok. <span style="color: var(--accent-blue);">Presisi Inventaris.</span></h1>
                <p class="hero-subtitle mb-5">Tinggalkan pencatatan manual yang rentan error. StockOps memberikan visibilitas real-time, audit trail otomatis, dan kontrol penuh atas pergerakan barang di gudang Anda.</p>

                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('login') }}" class="btn btn-accent text-decoration-none px-2 py-2">Coba Demo Sistem</a>
                    <a href="{{ route('login') }}"  class="btn btn-outline-light rounded-pill px-2 py-2">Masuk</a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="position-relative">
                    <div class="bg-white p-2 rounded-4 shadow-lg position-relative z-1">
                        <img src="images/landing.jpg" class="img-fluid rounded-3 border" alt="Dashboard Preview">
                    </div>
                    <div class="position-absolute rounded-4" style="background: var(--accent-blue); opacity: 0.2; top: 20px; left: -20px; right: 20px; bottom: -20px; z-index: 0;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

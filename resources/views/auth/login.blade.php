@extends('layouts.auth')

@section('title', 'Login')

@push('styles')
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
        }

        /* Background Container */
        .login-container {
            background: url("{{ asset('images/warehouse.jpg') }}");
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Card Styling */
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(100px);
            width: 100%;
            max-width: 400px;
        }

        .card-header {
            background: transparent !important;
            border-bottom: 1px solid #eee;
            padding: 2rem 1rem 1rem;
        }

        .card-header h4 {
            font-weight: 700;
            color: #0a2540; /* Tone biru dongker */
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(10, 37, 64, 0.15);
            border-color: #0a2540;
        }

        .btn-primary {
            background-color: #0d6efd; /* Bisa kamu ganti ke #0a2540 jika ingin full senada */
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0a2540;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(10, 37, 64, 0.3);
        }

        .brand-logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff;
            margin-bottom: 1.5rem;
            text-align: center;
            letter-spacing: 2px;
        }
    </style>
@endpush

@section('content')
    <div class="login-container">
        <div class="w-100 d-flex flex-column align-items-center px-3">


            <div class="card login-card">
                <div class="card-header text-center">
                    <h4>System Login</h4>
                    <p class="text-muted small mb-0">Silakan masuk untuk memulai sesi</p>
                </div>

                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger small py-2 d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <div>{{ $errors->first() }}</div>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success small py-2 d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                    @endif

                    <form action="{{ url('/login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold text-secondary">Email Address</label>
                            <input type="email" name="email" id="email"
                                   class="form-control" placeholder="nama@perusahaan.com" required autofocus>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label small fw-bold text-secondary">Password</label>
                            <input type="password" name="password" id="password"
                                   class="form-control" placeholder="••••••••" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Sign In
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer border-0 bg-transparent text-center pb-4">
                    <span class="text-muted small">&copy; {{ date('Y') }} Management System</span>
                </div>
            </div>
        </div>
    </div>
@endsection

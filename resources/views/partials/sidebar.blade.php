<div class="d-flex flex-column h-100 p-3">
    <a href="#" class="d-flex align-items-center mb-4 text-white text-decoration-none">
        <i class="bi bi-cpu-fill fs-3 me-2 text-info"></i>
        <span class="fs-5 fw-bold tracking-wide">Invent</span>
    </a>

    <hr class="text-white-50 mt-0">

    <ul class="nav nav-pills flex-column mb-auto gap-1">

        <li class="nav-item small fw-bold mb-1 mt-2 text-uppercase text-white">Main Menu</li>

        <li class="nav-item">
            <a href="{{ url('/dashboard') }}" class="nav-link text-white {{ request()->is('dashboard') ? 'active-menu' : '' }}">
                <i class="bi bi-grid-1x2 me-2"></i> Dashboard
            </a>
        </li>

        <li class="nav-item
         small fw-bold mb-1 mt-4 text-uppercase text-white">Modules</li>

        <li class="nav-item">
            <a href="{{url('/history')}}" class="nav-link text-white {{ request()->is('history') ? 'active-menu' : '' }}">
                <i class="bi bi-gear-wide-connected me-2"></i> History
            </a>
        </li>
        <li class="nav-item
         small fw-bold mb-1 mt-4 text-uppercase text-white">Master</li>

        <li class="nav-item">
            <a href="{{url('/materials')}}" class="nav-link text-white {{ request()->is('materials') ? 'active-menu' : '' }}">
                <i class="bi bi-box-seam me-2"></i> Material
            </a>
        </li>
    </ul>

    <hr class="text-white-50">

    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle fs-4 me-2"></i>
            <strong>{{ Auth::user()->name ?? 'Administrator' }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow border-0">
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger fw-bold">Sign out</button>
                </form>
            </li>
        </ul>
    </div>
</div>

<style>
    /* Styling khusus sidebar agar menyatu dengan layout */
    .sidebar-wrapper .nav-link {
        border-radius: 8px;
        transition: all 0.2s ease-in-out;
        opacity: 0.85;
    }
    .sidebar-wrapper .nav-link:hover {
        background-color: var(--navy-hover);
        opacity: 1;
        transform: translateX(4px); /* Animasi geser sedikit ke kanan */
    }
    .sidebar-wrapper .active-menu {
        background-color: rgba(255, 255, 255, 0.15) !important;
        opacity: 1;
        border-left: 4px solid #0dcaf0; /* Aksen garis biru muda */
    }
</style>

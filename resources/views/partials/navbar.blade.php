<header class="p-3 mb-0 border-bottom bg-white shadow-sm">
    <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">

        <div class="d-flex align-items-center">
            <h5 class="mb-0 fw-bold" style="color: var(--navy-primary);">
                @yield('page_title', 'Overview')
            </h5>
        </div>

        <div class="d-flex align-items-center justify-content-end">
            <form class="w-100 me-3" role="search" style="max-width: 300px;">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0" id="search-addon">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="search" class="form-control border-start-0 bg-light" placeholder="Search data..." aria-describedby="search-addon">
                </div>
            </form>

            <div class="flex-shrink-0">
                <a href="#" class="text-dark position-relative text-decoration-none">
                    <i class="bi bi-bell fs-5 text-muted hover-dark"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">New alerts</span>
                    </span>
                </a>
            </div>
        </div>

    </div>
</header>

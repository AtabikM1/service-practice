@extends('layouts.app')

@section('title', 'Dashboard - PT Indoprima')
@section('page_title', 'Dashboard Overview')

@section('content')
    <div class="container-fluid px-0">

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-3 h-100 border-start border-4 border-primary">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted fw-bold mb-2 text-uppercase">Total Material (SKU)</h6>
                                <h2 class="mb-0 fw-bold" style="color: var(--navy-primary);">
                                    {{ number_format($stats['total_material'], 0, ',', '.') }}
                                </h2>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary">
                                <i class="bi bi-box-seam fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-3 h-100 border-start border-4 border-success">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted fw-bold mb-2 text-uppercase">Total Kuantitas Fisik</h6>
                                <h2 class="mb-0 fw-bold text-success">
                                    {{ number_format($stats['total_qty'], 0, ',', '.') }}
                                </h2>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success">
                                <i class="bi bi-stack fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-3 h-100 border-start border-4 border-danger">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted fw-bold mb-2 text-uppercase">Material Kritis (< 10)</h6>
                                <h2 class="mb-0 fw-bold text-danger">
                                    {{ count($stats['low_stock_items']) }}
                                </h2>
                            </div>
                            <div class="bg-danger bg-opacity-10 p-3 rounded-circle text-danger">
                                <i class="bi bi-exclamation-triangle-fill fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">

            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                        <h6 class="fw-bold" style="color: var(--navy-primary);">
                            <i class="bi bi-clock-history me-2"></i>Aktivitas Terbaru (Ledger)
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light text-muted small">
                                <tr>
                                    <th>WAKTU</th>
                                    <th>MATERIAL</th>
                                    <th>TIPE TRX</th>
                                    <th class="text-end">QTY</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($stats['recent_activities'] as $activity)
                                    <tr>
                                        <td class="text-muted small">
                                            {{ $activity->created_at->diffForHumans() }}
                                        </td>
                                        <td class="fw-medium">
                                            {{ $activity->material->name ?? 'Unknown Material' }}
                                        </td>
                                        <td>
                                            @if(($activity->type ?? 'IN') == 'IN')
                                                <span class="badge bg-success bg-opacity-25 text-success border border-success">Masuk</span>
                                            @else
                                                <span class="badge bg-danger bg-opacity-25 text-danger border border-danger">Keluar</span>
                                            @endif
                                        </td>
                                        <td class="text-end fw-bold">
                                            {{ number_format($activity->quantity ?? 0) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                            Belum ada aktivitas tercatat
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-3 h-100 border-top border-4 border-warning">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                        <h6 class="fw-bold text-warning-emphasis">
                            <i class="bi bi-exclamation-circle me-2"></i>Segera Restock
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @forelse($stats['low_stock_items'] as $item)
                                <li class="list-group-item px-0 d-flex justify-content-between align-items-start border-light">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold" style="color: var(--navy-primary);">
                                            {{ $item->material->name ?? 'Unknown' }}
                                        </div>
                                        <small class="text-muted">ID: MAT-{{ str_pad($item->material_id, 4, '0', STR_PAD_LEFT) }}</small>
                                    </div>
                                    <span class="badge bg-danger rounded-pill">Sisa {{ $item->quantity }}</span>
                                </li>
                            @empty
                                <li class="list-group-item px-0 text-center py-4 text-muted border-0">
                                    <i class="bi bi-check-circle fs-3 text-success d-block mb-2"></i>
                                    Semua stok material dalam kondisi aman.
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

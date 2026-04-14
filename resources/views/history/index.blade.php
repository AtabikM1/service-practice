@extends('layouts.app')

@section('title', 'Riwayat Transaksi')
@section('page_title', 'Riwayat Transaksi Gudang')

@section('content')
    <div class="container-fluid px-0">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0" style="color: var(--navy-primary);">
                    <i class="bi bi-clock-history me-2"></i>Buku Besar (Ledger)
                </h6>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <form action="{{ route('history.index') }}" method="GET">
                            @if(request('sort'))
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                                <input type="hidden" name="direction" value="{{ request('direction') }}">
                            @endif

                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" name="search" class="form-control border-start-0"
                                       placeholder="Cari nama material..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">Cari</button>
                                @if(request('search'))
                                    <a href="{{ route('history.index') }}" class="btn btn-light border">Reset</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <div class="d-flex flex-wrap align-items-center gap-2 mb-4 bg-light p-2 rounded border">
                    <span class="small fw-bold text-muted me-2"><i class="bi bi-funnel me-1"></i> Urutkan:</span>

                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}"
                       class="badge rounded-pill text-decoration-none px-3 py-2 {{ request('sort') == 'created_at' ? 'bg-primary' : 'bg-white text-dark border' }}">
                        Waktu @if(request('sort') == 'created_at') <i class="bi bi-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i> @endif
                    </a>

                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'trans_type', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}"
                       class="badge rounded-pill text-decoration-none px-3 py-2 {{ request('sort') == 'trans_type' ? 'bg-primary' : 'bg-white text-dark border' }}">
                        Tipe @if(request('sort') == 'trans_type') <i class="bi bi-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i> @endif
                    </a>

                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'amount', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}"
                       class="badge rounded-pill text-decoration-none px-3 py-2 {{ request('sort') == 'amount' ? 'bg-primary' : 'bg-white text-dark border' }}">
                        Qty @if(request('sort') == 'amount') <i class="bi bi-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i> @endif
                    </a>
                </div>

                <div>
                    @forelse($histories as $log)
                        <div class="card shadow-sm border-0 mb-3 border-start border-4 {{ strtolower($log->trans_type) === 'in' ? 'border-success' : 'border-danger' }} bg-white">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="fw-bold mb-1 text-dark">{{ $log->material->name ?? 'Unknown Material' }}</h6>
                                        <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>{{ $log->created_at->format('d M Y, H:i') }}</small>
                                    </div>

                                    <div class="text-end">
                                        @if(strtolower($log->trans_type) === 'in')
                                            <span class="badge bg-success bg-opacity-25 text-success border border-success px-2 mb-1">IN</span>
                                            <div class="fw-bold text-success fs-5">
                                                +{{ number_format($log->amount, 0, ',', '.') }}
                                            </div>
                                        @else
                                            <span class="badge bg-danger bg-opacity-25 text-danger border border-danger px-2 mb-1">OUT</span>
                                            <div class="fw-bold text-danger fs-5">
                                                -{{ number_format($log->amount, 0, ',', '.') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-3 pt-2 border-top d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Saldo Akhir:</small>
                                    <span class="fw-bold text-secondary bg-light px-3 py-1 rounded">
                                        {{ number_format($log->balance_after, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted border rounded bg-light">
                            <i class="bi bi-journal-x fs-1 d-block mb-3 text-secondary bg-opacity-25"></i>
                            @if(request('search'))
                                Pencarian "{{ request('search') }}" tidak ditemukan.
                            @else
                                Belum ada riwayat transaksi tercatat.
                            @endif
                        </div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-end mt-4">
                    {{ $histories->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

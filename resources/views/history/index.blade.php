@extends('layouts.app')

@section('title', 'Riwayat Transaksi ')
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
                    <div class="col-md-5">
                        <form action="{{ route('history.index') }}" method="GET">
                            @if(request('sort'))
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                                <input type="hidden" name="direction" value="{{ request('direction') }}">
                            @endif

                            <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
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

                <div class="table-responsive rounded">
                    <table class="table table-hover align-middle border-top">
                        <thead class="table-light text-muted small">
                        <tr>
                            <th width="5%">NO</th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-muted">
                                    WAKTU TRANSAKSI
                                    @if(request('sort') == 'created_at')
                                        <i class="bi bi-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>MATERIAL</th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'trans_type', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-muted">
                                    TIPE
                                    @if(request('sort') == 'trans_type')
                                        <i class="bi bi-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th class="text-end">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'amount', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-muted">
                                    QTY
                                    @if(request('sort') == 'amount')
                                        <i class="bi bi-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th class="text-end">SALDO AKHIR</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($histories as $index => $log)
                            <tr>
                                <td class="text-muted">{{ $histories->firstItem() + $index }}</td>
                                <td class="small">
                                    {{ $log->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="fw-medium">
                                    {{ $log->material->name ?? 'Unknown Material' }}
                                </td>
                                <td>
                                    @if(strtolower($log->trans_type) === 'in')
                                        <span class="badge bg-success bg-opacity-25 text-success border border-success px-3">IN</span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-25 text-danger border border-danger px-3">OUT</span>
                                    @endif
                                </td>
                                <td class="text-end fw-bold {{ strtolower($log->trans_type) === 'in' ? 'text-success' : 'text-danger' }}">
                                    {{ strtolower($log->trans_type) === 'in' ? '+' : '-' }}{{ number_format($log->amount, 0, ',', '.') }}
                                </td>
                                <td class="text-end fw-bold text-secondary">
                                    {{ number_format($log->balance_after, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-journal-x fs-1 d-block mb-3 text-light"></i>
                                    @if(request('search'))
                                        Pencarian "{{ request('search') }}" tidak ditemukan.
                                    @else
                                        Belum ada riwayat transaksi tercatat.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    {{ $histories->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

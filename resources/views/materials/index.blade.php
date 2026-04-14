@extends('layouts.app')

@section('title', 'Master Material')
@section('page_title', 'Master Data Material')

@section('content')
    <div class="container-fluid px-0">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0" style="color: var(--navy-primary);">
                    <i class="bi bi-box-seam me-2"></i>Daftar Material
                </h6>
                <a href="{{ route('materials.create') }}" class="btn btn-primary btn-sm fw-medium">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Material
                </a>
            </div>

            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show small py-2">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $errors->first() }}
                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show small py-2" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="d-none d-md-block table-responsive rounded">
                    <table class="table table-hover align-middle border-top">
                        <thead class="table-light text-muted small">
                        <tr>
                            <th width="5%">NO</th>
                            <th width="20%">ID MATERIAL</th>
                            <th>NAME MATERIAL</th>
                            <th>BALANCE</th>
                            <th width="10%" class="text-center">AKSI</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($materials as $index => $item)
                            <tr>
                                <td class="text-muted">{{ $materials->firstItem() + $index }}</td>
                                <td>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary text-monospace">
                                        MAT-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td class="fw-medium">{{ $item->name }}</td>
                                <td class="fw-medium">{{ $item->stock->quantity ?? 0}}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-light text-muted border-0 rounded-circle" data-bs-toggle="modal" data-bs-target="#trxModal-{{ $item->id }}" title="Transaksi">
                                        <i class="bi bi-three-dots-vertical fs-6"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox-fill fs-1 d-block mb-3 text-light"></i>
                                    Belum ada data material.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-block d-md-none">
                    @forelse($materials as $item)
                        <div class="card shadow-sm border-0 mb-3 border-start border-4 border-primary bg-light bg-opacity-50">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary text-monospace mb-1">
                                            MAT-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                        </span>
                                        <h6 class="fw-bold mb-0 text-dark">{{ $item->name }}</h6>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-white shadow-sm border text-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#trxModal-{{ $item->id }}">
                                        <i class="bi bi-arrow-left-right"></i>
                                    </button>
                                </div>
                                <div class="mt-3 pt-2 border-top d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Balance Stok:</small>
                                    <span class="badge {{ ($item->stock->quantity ?? 0) > 0 ? 'bg-success' : 'bg-danger' }} rounded-pill px-3">
                                        {{ $item->stock->quantity ?? 0 }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted border rounded bg-light">
                            <i class="bi bi-inbox-fill fs-1 d-block mb-3 text-secondary bg-opacity-25"></i>
                            Belum ada data material.
                        </div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-end mt-3">
                    {{ $materials->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    @foreach($materials as $item)
        <div class="modal fade text-start" id="trxModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h6 class="modal-title fw-bold" style="color: var(--navy-primary);">
                            <i class="bi bi-arrow-left-right me-2"></i>Transaksi Stok
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ url('/stocks') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="alert alert-info py-2 small mb-4 border-0 bg-opacity-10">
                                Material: <strong>{{ $item->name }}</strong>
                            </div>

                            <input type="hidden" name="material_id" value="{{ $item->id }}">

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">Jenis Transaksi</label>
                                <select name="trans_type" class="form-select shadow-none" required>
                                    <option value="" disabled selected>-- Pilih Jenis --</option>
                                    <option value="in">Barang Masuk (IN)</option>
                                    <option value="out">Barang Keluar (OUT)</option>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label class="form-label small fw-bold text-secondary">Jumlah (Qty)</label>
                                <input type="number" name="amount" class="form-control shadow-none" min="1" placeholder="Masukkan angka..." required>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0 pt-0">
                            <button type="button" class="btn btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary px-4">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection

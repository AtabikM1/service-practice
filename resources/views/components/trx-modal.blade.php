@props(['item'])

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

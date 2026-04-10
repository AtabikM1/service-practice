@extends('layouts.app')

@section('title', isset($material) ? 'Edit Material' : 'Tambah Material')
@section('page_title', isset($material) ? 'Edit Data Material' : 'Tambah Material Baru')

@section('content')
    <div class="container-fluid px-0">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-2">
                        <h6 class="fw-bold mb-0" style="color: var(--navy-primary);">
                            <i class="bi {{ isset($material) ? 'bi-pencil-square' : 'bi-plus-circle' }} me-2"></i>
                            Formulir Material
                        </h6>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ isset($material) ? route('materials.update', $material->id) : route('materials.store') }}" method="POST">
                            @csrf
                            @if(isset($material))
                                @method('PUT')
                            @endif

                            <div class="mb-4">
                                <label for="name" class="form-label small fw-bold text-secondary">Nama Material <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', isset($material) ? $material->name : '') }}"
                                       placeholder="Contoh: Besi Baja 10mm" required autofocus>

                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between mt-5">
                                <a href="{{ route('materials.index') }}" class="btn btn-light fw-medium border">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary fw-medium px-4">
                                    <i class="bi bi-save me-1"></i> Simpan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

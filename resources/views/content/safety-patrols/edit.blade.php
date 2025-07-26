@extends('layouts/contentNavbarLayout')

@section('title', 'Update Data Safety Patrol')

@section('content')
    <div class="row">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="ri-check-line me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="ri-close-line me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Update Data Safety Patrol</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('safety-patrol.update', $safetyPatrol->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="inspector" class="form-control" name="inspector" 
                                placeholder="Inspector" value="{{ old('inspector', $safetyPatrol->inspector ?? '') }}">
                            <label for="inspector">Inspector</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <select class="form-select" id="klasifikasi_temuan" name="klasifikasi_temuan">
                                <option value="">Pilih Klasifikasi</option>
                                <option value="Unsafe Action" {{ old('klasifikasi_temuan', $safetyPatrol->klasifikasi_temuan ?? '') == 'Unsafe Action' ? 'selected' : '' }}>Unsafe Action</option>
                                <option value="Unsafe Condition" {{ old('klasifikasi_temuan', $safetyPatrol->klasifikasi_temuan ?? '') == 'Unsafe Condition' ? 'selected' : '' }}>Unsafe Condition</option>
                                <option value="Safe" {{ old('klasifikasi_temuan', $safetyPatrol->klasifikasi_temuan ?? '') == 'Safe' ? 'selected' : '' }}>Safe</option>
                            </select>
                            <label for="klasifikasi_temuan">Klasifikasi Temuan</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="kriteria" class="form-control" name="kriteria" 
                                placeholder="Temuan" value="{{ old('kriteria', $safetyPatrol->kriteria ?? '') }}">
                            <label for="kriteria">Temuan</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <select class="form-select @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi">
                                <option value="">Pilih Lokasi</option>
                                <option value="Halaman Parkir" {{ old('lokasi', $safetyPatrol->lokasi ?? '') == 'Halaman Parkir' ? 'selected' : '' }}>Halaman Parkir</option>
                                <option value="Office" {{ old('lokasi', $safetyPatrol->lokasi ?? '') == 'Office' ? 'selected' : '' }}>Office</option>
                                <option value="Warehouse" {{ old('lokasi', $safetyPatrol->lokasi ?? '') == 'Warehouse' ? 'selected' : '' }}>Warehouse</option>
                                <option value="Fabrikasi" {{ old('lokasi', $safetyPatrol->lokasi ?? '') == 'Fabrikasi' ? 'selected' : '' }}>Fabrikasi</option>
                                <option value="Mess" {{ old('lokasi', $safetyPatrol->lokasi ?? '') == 'Mess' ? 'selected' : '' }}>Mess</option>
                            </select>
                            <label for="lokasi">Lokasi</label>
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="date" id="tanggal" class="form-control" name="tanggal"
                                value="{{ old('tanggal') ?? $safetyPatrol->tanggal }}">
                            <label for="tanggal">Tanggal Pemeriksaan</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="risiko" class="form-control" name="risiko" 
                                placeholder="Risiko" value="{{ old('risiko', $safetyPatrol->risiko ?? '') }}">
                            <label for="risiko">Risiko</label>
                        </div>

                        @if ($safetyPatrol->foto_temuan)
                            <div class="mb-4">
                                <label class="form-label">Foto Temuan Saat Ini:</label><br>
                                <img src="{{ asset('storage/foto_temuan/' . $safetyPatrol->foto_temuan) }}"
                                    alt="Foto Temuan" class="img-fluid rounded border" style="max-width: 400px;">
                            </div>
                        @endif
                        <div class="mb-4">
                            <label for="foto_temuan" class="form-label">Upload Foto Temuan</label>
                            <input class="form-control" type="file" id="foto_temuan" name="foto_temuan" accept="image/*">
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="tindak_lanjut" class="form-control" name="tindak_lanjut"
                                placeholder="Tindak Lanjut" value="{{ old('tindak_lanjut', $safetyPatrol->tindak_lanjut ?? '') }}">
                            <label for="tindak_lanjut">Tindak Lanjut</label>
                        </div>

                        @if ($safetyPatrol->foto_tindak_lanjut ?? false)
                            <div class="mb-4">
                                <label class="form-label">Foto Tindak Lanjut Saat Ini:</label><br>
                                <img src="{{ asset('storage/foto_tindak_lanjut/' . $safetyPatrol->foto_tindak_lanjut) }}"
                                    alt="Foto Tindak Lanjut" class="img-fluid rounded border" style="max-width: 400px;">
                            </div>
                        @endif
                        <div class="mb-4">
                            <label for="foto_tindak_lanjut" class="form-label">Upload Foto Tindak Lanjut</label>
                            <input class="form-control" type="file" id="foto_tindak_lanjut" name="foto_tindak_lanjut" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary">Kirim Laporan</button>
                        <a href="{{ route('safety-patrol.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                            <select class="form-select" id="kriteria" name="kriteria">
                                <option
                                    value="APD"{{ old('kriteria', $safetyPatrol->kriteria ?? '') == 'APD' ? 'selected' : '' }}>
                                    APD</option>
                                <option
                                    value="Rambu Keselamatan"{{ old('kriteria', $safetyPatrol->kriteria ?? '') == 'Rambu Keselamatan' ? 'selected' : '' }}>
                                    Rambu Keselamatan</option>
                                <option
                                    value="Perilaku Pekerja"{{ old('kriteria', $safetyPatrol->kriteria ?? '') == 'Perilaku Pekerja' ? 'selected' : '' }}>
                                    Perilaku Pekerja</option>
                                <option
                                    value="Pengoperasian Alat"{{ old('kriteria', $safetyPatrol->kriteria ?? '') == 'Pengoperasian Alat' ? 'selected' : '' }}>
                                    Pengoperasian Alat</option>
                                <option
                                    value="Pelaksanaan Pekerjaan"{{ old('kriteria', $safetyPatrol->kriteria ?? '') == 'Pelaksanaan Pekerjaan' ? 'selected' : '' }}>
                                    Pelaksanaan Pekerjaan</option>
                            </select>
                            <label for="kriteria">Kriteria</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <select class="form-select  @error('lokasi') is-invalid @enderror" id="lokasi"
                                name="lokasi">
                                <option value="">Pilih Lokasi</option>
                                <option value="Halaman Parkir"
                                    {{ old('lokasi', $safetyPatrol->lokasi ?? '') == 'Halaman Parkir' ? 'selected' : '' }}>
                                    Halaman Parkir</option>
                                <option value="Office"
                                    {{ old('lokasi', $safetyPatrol->lokasi ?? '') == 'Office' ? 'selected' : '' }}>
                                    Office</option>
                                <option value="Warehouse"
                                    {{ old('lokasi', $safetyPatrol->lokasi ?? '') == 'Warehouse' ? 'selected' : '' }}>
                                    Warehouse</option>
                                <option value="Fabrikasi"
                                    {{ old('lokasi', $safetyPatrol->lokasi ?? '') == 'Fabrikasi' ? 'selected' : '' }}>
                                    Fabrikasi</option>
                                <option value="Mess"
                                    {{ old('lokasi', $safetyPatrol->lokasi ?? '') == 'Mess' ? 'selected' : '' }}>
                                    Mess</option>
                            </select>
                            <label for="identifikasi_lokasi">Lokasi</label>
                            @error('identifikasi_lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <select name="temuan" class="form-select">
                                <option value="Safe"
                                    {{ old('temuan', $safetyPatrol->temuan ?? '') == 'Safe' ? 'selected' : '' }}>
                                    Safe</option>
                                <option value="Unsafe Action"
                                    {{ old('temuan', $safetyPatrol->temuan ?? '') == 'Unsafe Action' ? 'selected' : '' }}>
                                    Unsafe Action</option>
                                <option value="Unsafe Condition"
                                    {{ old('temuan', $safetyPatrol->temuan ?? '') == 'Unsafe Condition' ? 'selected' : '' }}>
                                    Unsafe Condition</option>
                            </select>
                            <label for="temuan">Temuan (S/UA/UC)</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="date" id="tanggal" class="form-control" name="tanggal"
                                value="{{ old('tanggal') ?? $safetyPatrol->tanggal }}">
                            <label for="tanggal">Tanggal Pemeriksaan</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <select class="form-select" id="kesesuaian" name="kesesuaian">
                                <option value="Baik"
                                    {{ old('kesesuaian', $safetyPatrol->kesesuaian ?? '') == 'Baik' ? 'selected' : '' }}>
                                    Baik
                                </option>
                                <option value="Buruk"
                                    {{ old('kesesuaian', $safetyPatrol->kesesuaian ?? '') == 'Buruk' ? 'selected' : '' }}>
                                    Buruk
                                </option>
                            </select>
                            <label for="kesesuaian">Kesesuaian</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="risiko" class="form-control" name="risiko" placeholder="Risiko"
                                value="{{ old('risiko', $safetyPatrol->risiko) }}">
                            <label for="risiko">Risiko</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="tindak_lanjut" class="form-control" name="tindak_lanjut"
                                placeholder="Tindak Lanjut"
                                value="{{ old('tindak_lanjut', $safetyPatrol->tindak_lanjut) }}">
                            <label for="tindak_lanjut">Tindak Lanjut</label>
                        </div>

                        @if ($safetyPatrol->foto_temuan)
                            <div class="mb-4">
                                <label class="form-label">Foto Temuan:</label><br>
                                <img src="{{ asset('storage/foto_temuan/' . $safetyPatrol->foto_temuan) }}"
                                    alt="Foto Temuan" class="img-fluid rounded border" style="max-width: 400px;">
                            </div>
                        @endif
                        <div class="mb-4">
                            <label for="foto_temuan" class="form-label">Ganti Foto Temuan (Opsional)</label>
                            <input class="form-control" type="file" id="foto_temuan" name="foto_temuan"
                                accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary">Kirim Laporan</button>
                        <a href="{{ route('safety-patrol.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

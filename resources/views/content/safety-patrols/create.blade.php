@extends('layouts/contentNavbarLayout')

@section('title', 'Form Safety Patrol')

@section('content')
    <div class="row">
        <div class="col-xl">
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
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Safety Patrol</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('safety-patrol.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="inspector" class="form-control" name="inspector" 
                                placeholder="Inspector" value="{{ old('inspector') }}">
                            <label for="inspector">Inspector</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <select class="form-select" id="klasifikasi_temuan" name="klasifikasi_temuan">
                                <option value="">Pilih Klasifikasi</option>
                                <option value="Unsafe Action">Unsafe Action</option>
                                <option value="Unsafe Condition">Unsafe Condition</option>
                                <option value="Safe">Safe</option>
                            </select>
                            <label for="klasifikasi_temuan">Klasifikasi Temuan</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="kriteria" class="form-control" name="kriteria" 
                                placeholder="Temuan" value="{{ old('kriteria') }}">
                            <label for="temuan">Temuan</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <select class="form-select" id="lokasi" name="lokasi">
                                <option value="">Pilih Lokasi</option>
                                <option value="Halaman Parkir">Halaman Parkir</option>
                                <option value="Office">Office</option>
                                <option value="Warehouse">Warehouse</option>
                                <option value="Fabrikasi">Fabrikasi</option>
                                <option value="Mess">Mess</option>
                            </select>
                            <label for="lokasi">Lokasi</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="date" id="tanggal" class="form-control" name="tanggal"
                                value="{{ old('tanggal') }}">
                            <label for="tanggal">Tanggal Pemeriksaan</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="risiko" class="form-control" name="risiko" placeholder="Risiko"
                                value="{{ old('risiko') }}">
                            <label for="risiko">Risiko</label>
                        </div>

                        <div class="mb-4">
                            <label for="foto_temuan" class="form-label">Upload Foto Temuan</label>
                            <input class="form-control" type="file" id="foto_temuan" name="foto_temuan" accept="image/*">
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="tindak_lanjut" class="form-control" name="tindak_lanjut"
                                placeholder="Tindak Lanjut" value="{{ old('tindak_lanjut') }}">
                            <label for="tindak_lanjut">Tindak Lanjut</label>
                        </div>

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

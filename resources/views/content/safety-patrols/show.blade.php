@extends('layouts/contentNavbarLayout')

@section('title', 'Data Safety Patrol')

@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Safety Patrol</h5>
                </div>
                <div class="card-body">

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" id="inspector" class="form-control" name="inspector" placeholder="Inspector"
                            value="{{ old('inspector') ?? $safetyPatrol->inspector ?? '' }}" disabled>
                        <label for="inspector">Inspector</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" id="klasifikasi_temuan" class="form-control" name="klasifikasi_temuan" placeholder="Klasifikasi Temuan"
                            value="{{ old('klasifikasi_temuan') ?? $safetyPatrol->klasifikasi_temuan ?? '' }}" disabled>
                        <label for="klasifikasi_temuan">Klasifikasi Temuan</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" id="kriteria" class="form-control" name="kriteria" placeholder="Temuan"
                            value="{{ old('kriteria') ?? $safetyPatrol->kriteria ?? '' }}" disabled>
                        <label for="kriteria">Temuan</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" id="lokasi" class="form-control" name="lokasi" placeholder="Lokasi"
                            value="{{ old('lokasi') ?? $safetyPatrol->lokasi }}" disabled>
                        <label for="lokasi">Lokasi</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="date" id="tanggal" class="form-control" name="tanggal"
                            value="{{ old('tanggal') ?? $safetyPatrol->tanggal }}" disabled>
                        <label for="tanggal">Tanggal Pemeriksaan</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" id="risiko" class="form-control" name="risiko" placeholder="Risiko"
                            value="{{ old('risiko') ?? $safetyPatrol->risiko ?? '' }}" disabled>
                        <label for="risiko">Risiko</label>
                    </div>

                    @if($safetyPatrol->status == 'unverified' && $safetyPatrol->note)
                    <div class="alert alert-warning">
                        <h6 class="alert-heading fw-bold mb-1">Catatan SPV:</h6>
                        <p class="mb-0">{{ $safetyPatrol->note }}</p>
                    </div>
                    @endif

                    @if ($safetyPatrol->foto_temuan)
                        <div class="mb-4">
                            <label class="form-label">Foto Temuan</label>
                            <div>
                                <img src="{{ asset('storage/foto_temuan/' . $safetyPatrol->foto_temuan) }}" alt="Foto Temuan"
                                    class="img-fluid" style="max-width: 300px; height: auto;">
                            </div>
                        </div>
                    @endif

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" id="tindak_lanjut" class="form-control" name="tindak_lanjut"
                            placeholder="Tindak Lanjut" value="{{ old('tindak_lanjut', $safetyPatrol->tindak_lanjut) }}"
                            disabled>
                        <label for="tindak_lanjut">Tindak Lanjut</label>
                    </div>

                    @if ($safetyPatrol->foto_tindak_lanjut)
                        <div class="mb-4">
                            <label class="form-label">Foto Tindak Lanjut</label>
                            <div>
                                <img src="{{ asset('storage/foto_tindak_lanjut/' . $safetyPatrol->foto_tindak_lanjut) }}" alt="Foto Tindak Lanjut"
                                    class="img-fluid" style="max-width: 300px; height: auto;">
                            </div>
                        </div>
                    @endif
                    {{-- Role-based PDF download access --}}
                    @if(auth()->user()->role === 'supervisor')
                        <a href="{{ route('safety-patrol.export-pdf', $safetyPatrol->id) }}" target="_blank"
                            class="btn btn-danger">
                            Download PDF
                        </a>
                    @endif
                    <a href="{{ route('safety-patrol.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection

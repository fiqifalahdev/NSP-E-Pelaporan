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
                        <input type="text" id="kriteria" class="form-control" name="kriteria" placeholder="Kriteria"
                            value="{{ old('kriteria') ?? $safetyPatrol->kriteria }}" disabled>
                        <label for="kriteria">Kriteria</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" id="lokasi" class="form-control" name="lokasi" placeholder="Lokasi"
                            value="{{ old('lokasi') ?? $safetyPatrol->lokasi }}" disabled>
                        <label for="lokasi">Lokasi</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <select name="temuan" class="form-select" disabled>
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
                            value="{{ old('tanggal') ?? $safetyPatrol->tanggal }}" disabled>
                        <label for="tanggal">Tanggal Pemeriksaan</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-select" id="kesesuaian" name="kesesuaian" disabled>
                            <option value="{{ old('kesesuaian', $safetyPatrol->kesesuaian ?? '') == 'Baik' }}">Baik
                            </option>
                            <option value="{{ old('kesesuaian', $safetyPatrol->kesesuaian ?? '') == 'Buruk' }}">Buruk
                            </option>
                        </select>
                        <label for="kesesuaian">Kesesuaian</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" id="risiko" class="form-control" name="risiko" placeholder="Risiko"
                            value="{{ old('risiko', $safetyPatrol->risiko) }}" disabled>
                        <label for="risiko">Risiko</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" id="tindak_lanjut" class="form-control" name="tindak_lanjut"
                            placeholder="Tindak Lanjut" value="{{ old('tindak_lanjut', $safetyPatrol->tindak_lanjut) }}"
                            disabled>
                        <label for="tindak_lanjut">Tindak Lanjut</label>
                    </div>

                    @if ($safetyPatrol->foto_temuan)
                        <div class="mb-4">
                            <label class="form-label">Foto Temuan:</label><br>
                            <img src="{{ asset('storage/foto_temuan/' . $safetyPatrol->foto_temuan) }}" alt="Foto Temuan"
                                class="img-fluid rounded border" style="max-width: 400px;">
                        </div>
                    @endif
                    <a href="{{ route('safety-patrol.export-pdf', $safetyPatrol->id) }}" target="_blank"
                        class="btn btn-danger">
                        Download PDF
                    </a>
                    <a href="{{ route('safety-patrol.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection

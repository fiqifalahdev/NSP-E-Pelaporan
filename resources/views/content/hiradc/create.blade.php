@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah Data HIRADC')

@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Tambah Data HIRADC</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('hiradc.store') }}" method="POST">
                        @csrf

                        <h6>Identifikasi Bahaya</h6>

                        <div class="form-floating form-floating-outline mb-4">
                            <select class="form-select" id="identifikasi_lokasi" name="identifikasi_lokasi">
                                <option value="">Pilih Lokasi</option>
                                <option value="Halaman Parkir">Halaman Parkir</option>
                                <option value="Office">Office</option>
                                <option value="Warehouse">Warehouse</option>
                                <option value="Fabrikasi">Fabrikasi</option>
                                <option value="Mess">Mess</option>
                            </select>
                            <label for="identifikasi_lokasi">Lokasi</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="identifikasi_aktifitas" class="form-control"
                                name="identifikasi_aktifitas" placeholder="Aktifitas"
                                value="{{ old('identifikasi_aktifitas') }}">
                            <label for="identifikasi_aktifitas">Aktifitas</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <textarea id="identifikasi_potensi_bahaya" class="form-control" name="identifikasi_potensi_bahaya"
                                placeholder="Potensi Bahaya" style="height: 80px">{{ old('identifikasi_potensi_bahaya') }}</textarea>
                            <label for="identifikasi_potensi_bahaya">Potensi Bahaya</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <textarea id="identifikasi_dampak_bahaya" class="form-control" name="identifikasi_dampak_bahaya"
                                placeholder="Dampak Bahaya" style="height: 80px">{{ old('identifikasi_dampak_bahaya') }}</textarea>
                            <label for="identifikasi_dampak_bahaya">Dampak Bahaya</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="identifikasi_PIC" class="form-control" name="identifikasi_PIC"
                                placeholder="PIC" value="{{ old('identifikasi_PIC') }}">
                            <label for="identifikasi_PIC">PIC</label>
                        </div>

                        <hr class="my-4">

                        <h6>Pengendalian Yang sudah ada</h6>

                        <div class="form-floating form-floating-outline mb-4">
                            <textarea id="control_uraian" class="form-control" name="control_uraian" placeholder="Uraian Kontrol"
                                style="height: 80px">{{ old('control_uraian') }}</textarea>
                            <label for="control_uraian">Uraian Kontrol</label>
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Poin Kemungkinan</label>
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="control_poin_kemungkinan"
                                        id="control_kemungkinan_{{ $i }}" value="{{ $i }}"
                                        {{ old('control_poin_kemungkinan') == $i ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="control_kemungkinan_{{ $i }}">{{ $i }}</label>
                                </div>
                            @endfor
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Poin Keparahan</label>
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="control_poin_keparahan"
                                        id="control_keparahan_{{ $i }}" value="{{ $i }}"
                                        {{ old('control_poin_keparahan') == $i ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="control_keparahan_{{ $i }}">{{ $i }}</label>
                                </div>
                            @endfor
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="number" id="control_nilai_resiko" class="form-control" name="control_nilai_resiko"
                                placeholder="Nilai Risiko" value="{{ old('control_nilai_resiko') }}" readonly>
                            <label for="control_nilai_resiko">Nilai Risiko</label>
                        </div>

                        <hr class="my-4">

                        <h6>Rekomendasi Pengendalian</h6>

                        <div class="form-floating form-floating-outline mb-4">
                            <textarea id="recom_uraian" class="form-control" name="recom_uraian" placeholder="Uraian Rekomendasi"
                                style="height: 80px">{{ old('recom_uraian') }}</textarea>
                            <label for="recom_uraian">Uraian Rekomendasi</label>
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Poin Kemungkinan</label>
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="recom_poin_kemungkinan"
                                        id="recom_kemungkinan_{{ $i }}" value="{{ $i }}"
                                        {{ old('recom_poin_kemungkinan') == $i ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="recom_kemungkinan_{{ $i }}">{{ $i }}</label>
                                </div>
                            @endfor
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Poin Keparahan</label>
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="recom_poin_keparahan"
                                        id="recom_keparahan_{{ $i }}" value="{{ $i }}"
                                        {{ old('recom_poin_keparahan') == $i ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="recom_keparahan_{{ $i }}">{{ $i }}</label>
                                </div>
                            @endfor
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="number" id="recom_nilai_resiko" class="form-control" name="recom_nilai_resiko"
                                placeholder="Nilai Risiko" value="{{ old('recom_nilai_resiko') }}" readonly>
                            <label for="recom_nilai_resiko">Nilai Risiko</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('hiradc.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ['control', 'recom'].forEach(function(prefix) {
                const updateRisk = () => {
                    const kemungkinan = document.querySelector(
                        `input[name="${prefix}_poin_kemungkinan"]:checked`);
                    const keparahan = document.querySelector(
                        `input[name="${prefix}_poin_keparahan"]:checked`);
                    const inputNilai = document.querySelector(`input[name="${prefix}_nilai_resiko"]`);

                    if (kemungkinan && keparahan) {
                        const nilai = parseInt(kemungkinan.value) * parseInt(keparahan.value);
                        inputNilai.value = nilai;
                    }
                };

                document.querySelectorAll(`input[name="${prefix}_poin_kemungkinan"]`).forEach(el => {
                    el.addEventListener('change', updateRisk);
                });

                document.querySelectorAll(`input[name="${prefix}_poin_keparahan"]`).forEach(el => {
                    el.addEventListener('change', updateRisk);
                });
            });
        });
    </script>
@endsection

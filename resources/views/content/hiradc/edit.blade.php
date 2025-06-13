@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Data HIRADC')

@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Data HIRADC</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('hiradc.update', $hiradc->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h6>Identifikasi Bahaya</h6>

                        <div class="form-floating form-floating-outline mb-4">
                            {{-- <input type="text" class="form-control @error('identifikasi_lokasi') is-invalid @enderror"
                                name="identifikasi_lokasi"
                                value="{{ old('identifikasi_lokasi', $hiradc->identifikasi_lokasi) }}"> --}}
                            <select class="form-select  @error('identifikasi_lokasi') is-invalid @enderror"
                                id="identifikasi_lokasi" name="identifikasi_lokasi">
                                <option value="">Pilih Lokasi</option>
                                <option value="Halaman Parkir"
                                    {{ old('identifikasi_lokasi', $hiradc->identifikasi_lokasi ?? '') == 'Halaman Parkir' ? 'selected' : '' }}>
                                    Halaman Parkir</option>
                                <option value="Office"
                                    {{ old('identifikasi_lokasi', $hiradc->identifikasi_lokasi ?? '') == 'Office' ? 'selected' : '' }}>
                                    Office</option>
                                <option value="Warehouse"
                                    {{ old('identifikasi_lokasi', $hiradc->identifikasi_lokasi ?? '') == 'Warehouse' ? 'selected' : '' }}>
                                    Warehouse</option>
                                <option value="Fabrikasi"
                                    {{ old('identifikasi_lokasi', $hiradc->identifikasi_lokasi ?? '') == 'Fabrikasi' ? 'selected' : '' }}>
                                    Fabrikasi</option>
                                <option value="Mess"
                                    {{ old('identifikasi_lokasi', $hiradc->identifikasi_lokasi ?? '') == 'Mess' ? 'selected' : '' }}>
                                    Mess</option>
                            </select>
                            <label for="identifikasi_lokasi">Lokasi</label>
                            @error('identifikasi_lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" name="identifikasi_aktifitas"
                                value="{{ old('identifikasi_aktifitas', $hiradc->identifikasi_aktifitas) }}">
                            <label for="identifikasi_aktifitas">Aktifitas</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <textarea class="form-control" name="identifikasi_potensi_bahaya" style="height: 80px">{{ old('identifikasi_potensi_bahaya', $hiradc->identifikasi_potensi_bahaya) }}</textarea>
                            <label for="identifikasi_potensi_bahaya">Potensi Bahaya</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <textarea class="form-control" name="identifikasi_dampak_bahaya" style="height: 80px">{{ old('identifikasi_dampak_bahaya', $hiradc->identifikasi_dampak_bahaya) }}</textarea>
                            <label for="identifikasi_dampak_bahaya">Dampak Bahaya</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" name="identifikasi_PIC"
                                value="{{ old('identifikasi_PIC', $hiradc->identifikasi_PIC) }}">
                            <label for="identifikasi_PIC">PIC</label>
                        </div>

                        <hr class="my-4">

                        <h6>Pengendalian Yang Sudah Ada</h6>

                        <div class="form-floating form-floating-outline mb-4">
                            <textarea class="form-control" name="control_uraian" style="height: 80px">{{ old('control_uraian', $hiradc->control_uraian) }}</textarea>
                            <label for="control_uraian">Uraian Kontrol</label>
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Poin Kemungkinan</label>
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="control_poin_kemungkinan"
                                        id="control_kemungkinan_{{ $i }}" value="{{ $i }}"
                                        {{ old('control_poin_kemungkinan', $hiradc->control_poin_kemungkinan) == $i ? 'checked' : '' }}>
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
                                        {{ old('control_poin_keparahan', $hiradc->control_poin_keparahan) == $i ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="control_keparahan_{{ $i }}">{{ $i }}</label>
                                </div>
                            @endfor
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input disabled type="number" class="form-control" id="control_nilai_resiko_view"
                                value="{{ $hiradc->control_nilai_resiko }}">
                            <input type="hidden" name="control_nilai_resiko" id="control_nilai_resiko"
                                value="{{ $hiradc->control_nilai_resiko }}">
                            <label for="control_nilai_resiko_view">Nilai Risiko</label>
                        </div>

                        <hr class="my-4">

                        <h6>Rekomendasi Pengendalian</h6>

                        <div class="form-floating form-floating-outline mb-4">
                            <textarea class="form-control" name="recom_uraian" style="height: 80px">{{ old('recom_uraian', $hiradc->recom_uraian) }}</textarea>
                            <label for="recom_uraian">Uraian Rekomendasi</label>
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Poin Kemungkinan</label>
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="recom_poin_kemungkinan"
                                        id="recom_kemungkinan_{{ $i }}" value="{{ $i }}"
                                        {{ old('recom_poin_kemungkinan', $hiradc->recom_poin_kemungkinan) == $i ? 'checked' : '' }}>
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
                                        {{ old('recom_poin_keparahan', $hiradc->recom_poin_keparahan) == $i ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="recom_keparahan_{{ $i }}">{{ $i }}</label>
                                </div>
                            @endfor
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input disabled type="number" class="form-control" id="recom_nilai_resiko_view"
                                value="{{ $hiradc->recom_nilai_resiko }}">
                            <input type="hidden" name="recom_nilai_resiko" id="recom_nilai_resiko"
                                value="{{ $hiradc->recom_nilai_resiko }}">
                            <label for="recom_nilai_resiko_view">Nilai Risiko</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('hiradc.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sections = ['control', 'recom'];

            sections.forEach(type => {
                const kemungkinanInputs = document.querySelectorAll(
                    `input[name="${type}_poin_kemungkinan"]`);
                const keparahanInputs = document.querySelectorAll(`input[name="${type}_poin_keparahan"]`);
                const nilaiResikoInput = document.getElementById(`${type}_nilai_resiko`);
                const nilaiResikoView = document.getElementById(`${type}_nilai_resiko_view`);

                function hitungNilaiRisiko() {
                    const kemungkinan = parseInt(document.querySelector(
                        `input[name="${type}_poin_kemungkinan"]:checked`)?.value || 0);
                    const keparahan = parseInt(document.querySelector(
                        `input[name="${type}_poin_keparahan"]:checked`)?.value || 0);
                    const nilaiRisiko = kemungkinan * keparahan;
                    nilaiResikoInput.value = nilaiRisiko;
                    nilaiResikoView.value = nilaiRisiko;
                }

                kemungkinanInputs.forEach(item => item.addEventListener('change', hitungNilaiRisiko));
                keparahanInputs.forEach(item => item.addEventListener('change', hitungNilaiRisiko));

                // Inisialisasi saat halaman dimuat
                hitungNilaiRisiko();
            });
        });
    </script>
@endsection

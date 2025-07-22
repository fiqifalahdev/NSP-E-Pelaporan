@extends('layouts/contentNavbarLayout')

@section('title', 'Data HIRADC')

@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data HIRADC</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('hiradc.store') }}" method="POST">
                        @csrf

                        <h6>Identifikasi Bahaya</h6>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" name="identifikasi_lokasi" placeholder="Lokasi"
                                disabled value="{{ $hiradc['identifikasi_lokasi'] }}">
                            <label for="identifikasi_lokasi">Lokasi</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" name="identifikasi_aktifitas" placeholder="Aktifitas"
                                disabled value="{{ $hiradc['identifikasi_aktifitas'] }}">
                            <label for="identifikasi_aktifitas">Aktifitas</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <textarea disabled class="form-control" name="identifikasi_potensi_bahaya" placeholder="Potensi Bahaya"
                                style="height: 80px">{{ $hiradc['identifikasi_potensi_bahaya'] }}</textarea>
                            <label for="identifikasi_potensi_bahaya">Potensi Bahaya</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <textarea disabled class="form-control" name="identifikasi_dampak_bahaya" placeholder="Dampak Bahaya"
                                style="height: 80px">{{ $hiradc['identifikasi_dampak_bahaya'] }}</textarea>
                            <label for="identifikasi_dampak_bahaya">Dampak Bahaya</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" name="identifikasi_PIC" placeholder="PIC" disabled
                                value="{{ $hiradc['identifikasi_PIC'] }}">
                            <label for="identifikasi_PIC">PIC</label>
                        </div>

                        <hr class="my-4">

                        @if($hiradc['status'] == 'unverified' && $hiradc['note'])
                        <div class="alert alert-warning">
                            <h6 class="alert-heading fw-bold mb-1">Catatan SPV:</h6>
                            <p class="mb-0">{{ $hiradc['note'] }}</p>
                        </div>
                        @endif

                        <h6>Pengendalian Yang sudah ada</h6>

                        <div class="form-floating form-floating-outline mb-4">
                            <textarea disabled class="form-control" name="control_uraian" placeholder="Uraian Kontrol" style="height: 80px">{{ $hiradc['control_uraian'] }}</textarea>
                            <label for="control_uraian">Uraian Kontrol</label>
                        </div>

                        <!-- Radio Button untuk Poin Kemungkinan -->
                        <div class="mb-4">
                            <label class="form-label d-block">Poin Kemungkinan</label>
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="form-check form-check-inline">
                                    <input disabled class="form-check-input" type="radio" name="control_poin_kemungkinan"
                                        id="control_kemungkinan_{{ $i }}" value="{{ $i }}"
                                        {{ $hiradc['control_poin_kemungkinan'] == $i ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="control_kemungkinan_{{ $i }}">{{ $i }}</label>
                                </div>
                            @endfor
                        </div>

                        <!-- Radio Button untuk Poin Keparahan -->
                        <div class="mb-4">
                            <label class="form-label d-block">Poin Keparahan</label>
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="form-check form-check-inline">
                                    <input disabled class="form-check-input" type="radio" name="control_poin_keparahan"
                                        id="control_keparahan_{{ $i }}" value="{{ $i }}"
                                        {{ $hiradc['control_poin_keparahan'] == $i ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="control_keparahan_{{ $i }}">{{ $i }}</label>
                                </div>
                            @endfor
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="number" class="form-control" name="control_nilai_resiko"
                                placeholder="Nilai Risiko" disabled value="{{ $hiradc['control_nilai_resiko'] }}">
                            <label for="control_nilai_resiko">Nilai Risiko</label>
                        </div>

                        <hr class="my-4">

                        <h6>Rekomendasi Pengendalian</h6>

                        <div class="form-floating form-floating-outline mb-4">
                            <textarea disabled class="form-control" name="recom_uraian" placeholder="Uraian Rekomendasi" style="height: 80px">{{ $hiradc['recom_uraian'] }}</textarea>
                            <label for="recom_uraian">Uraian Rekomendasi</label>
                        </div>

                        <!-- Radio Button untuk Poin Kemungkinan -->
                        <div class="mb-4">
                            <label class="form-label d-block">Poin Kemungkinan</label>
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="form-check form-check-inline">
                                    <input disabled class="form-check-input" type="radio" name="recom_poin_kemungkinan"
                                        id="recom_kemungkinan_{{ $i }}" value="{{ $i }}"
                                        {{ $hiradc['recom_poin_kemungkinan'] == $i ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="recom_kemungkinan_{{ $i }}">{{ $i }}</label>
                                </div>
                            @endfor
                        </div>

                        <!-- Radio Button untuk Poin Keparahan -->
                        <div class="mb-4">
                            <label class="form-label d-block">Poin Keparahan</label>
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="form-check form-check-inline">
                                    <input disabled class="form-check-input" type="radio" name="recom_poin_keparahan"
                                        id="recom_keparahan_{{ $i }}" value="{{ $i }}"
                                        {{ $hiradc['recom_poin_keparahan'] == $i ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="recom_keparahan_{{ $i }}">{{ $i }}</label>
                                </div>
                            @endfor
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="number" class="form-control" name="recom_nilai_resiko"
                                placeholder="Nilai Risiko" disabled value="{{ $hiradc['recom_nilai_resiko'] }}">
                            <label for="recom_nilai_resiko">Nilai Risiko</label>
                        </div>

                        <a href="{{ route('hiradc.export-pdf', $hiradc->id) }}" target="_blank" class="btn btn-danger">
                            Download PDF
                        </a>
                        <a href="{{ route('hiradc.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // script untuk menghitung nilai risiko
        document.addEventListener('DOMContentLoaded', function() {
            const typeInput = ['control', 'recom'];
            typeInput.forEach(type => {
                const kemungkinan = document.querySelectorAll(`input[name="${type}_poin_kemungkinan"]`);
                const keparahan = document.querySelectorAll(`input[name="${type}_poin_keparahan"]`);
                const nilaiResikoInput = document.querySelector(`input[name="${type}_nilai_resiko"]`);

                kemungkinan.forEach(item => {
                    item.addEventListener('change', hitungNilaiRisiko);
                });

                keparahan.forEach(item => {
                    item.addEventListener('change', hitungNilaiRisiko);
                });

                function hitungNilaiRisiko() {
                    const kemungkinan = parseInt(document.querySelector(
                        `input[name="${type}_poin_kemungkinan"]:checked`).value);
                    const keparahan = parseInt(document.querySelector(
                        `input[name="${type}_poin_keparahan"]:checked`).value);
                    const nilaiRisiko = kemungkinan * keparahan;
                    nilaiResikoInput.value = nilaiRisiko;
                }
            });
        });
    </script>
@endsection

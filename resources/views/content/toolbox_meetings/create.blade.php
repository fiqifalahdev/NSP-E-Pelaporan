@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah Toolbox Meeting')

@section('content')
<div class="row">
    <div class="col-xl">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="ri-close-line me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Tambah Toolbox Meeting</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('toolbox-meetings.store') }}" method="POST">
                    @csrf

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                        <label for="tanggal">Tanggal</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}">
                        <label for="penanggung_jawab">Penanggung Jawab</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan') }}">
                        <label for="jabatan">Jabatan</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <textarea class="form-control" placeholder="Uraian Aktivitas" id="uraian_aktivitas" name="uraian_aktivitas" style="height: 100px">{{ old('uraian_aktivitas') }}</textarea>
                        <label for="uraian_aktivitas">Uraian Aktivitas</label>
                    </div>
                    
                    <div class="form-floating form-floating-outline mb-4">
                        <textarea class="form-control" placeholder="Keterangan" id="keterangan" name="keterangan" style="height: 100px">{{ old('keterangan') }}</textarea>
                        <label for="keterangan">Keterangan</label>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Daftar Kehadiran</label>
                        <div id="kehadiran-wrapper">
                            <div class="input-group mb-2">
                                <input type="text" name="kehadiran[]" class="form-control" placeholder="Nama Peserta">
                                <button type="button" class="btn btn-outline-secondary btn-remove">-</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" id="btn-add-kehadiran">+ Tambah Peserta</button>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('toolbox-meetings.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('btn-add-kehadiran').addEventListener('click', function () {
        console.log('oke')
        const wrapper = document.getElementById('kehadiran-wrapper');
        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-2';
        inputGroup.innerHTML = `
            <input type="text" name="kehadiran[]" class="form-control" placeholder="Nama Peserta">
            <button type="button" class="btn btn-outline-secondary btn-remove">-</button>
        `;
        wrapper.appendChild(inputGroup);
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('btn-remove')) {
            e.target.closest('.input-group').remove();
        }
    });
</script>
@endpush
@endsection

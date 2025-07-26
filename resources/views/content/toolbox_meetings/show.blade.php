@extends('layouts/contentNavbarLayout')

@section('title', 'Detail Toolbox Meeting')

@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Toolbox Meeting</h5>
                </div>
                <div class="card-body">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                            value="{{ old('tanggal', \Carbon\Carbon::parse($toolboxMeeting->tanggal)->format('Y-m-d')) }}"
                            disabled>
                        <label for="tanggal">Tanggal</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab"
                            value="{{ old('penanggung_jawab', $toolboxMeeting->penanggung_jawab) }}" disabled>
                        <label for="penanggung_jawab">Penanggung Jawab</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="jabatan" name="jabatan"
                            value="{{ old('jabatan', $toolboxMeeting->jabatan) }}" disabled>
                        <label for="jabatan">Jabatan</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <textarea class="form-control" placeholder="Uraian Aktivitas" id="uraian_aktivitas" name="uraian_aktivitas"
                            style="height: 100px" disabled>{{ old('uraian_aktivitas', $toolboxMeeting->uraian_aktivitas) }}</textarea>
                        <label for="uraian_aktivitas">Uraian Aktivitas</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <textarea class="form-control" placeholder="Keterangan" id="keterangan" name="keterangan" style="height: 100px"
                            disabled>{{ old('keterangan', $toolboxMeeting->keterangan) }}</textarea>
                        <label for="keterangan">Keterangan</label>
                    </div>

                    @php
                        $listKehadiran = is_array($toolboxMeeting->kehadiran)
                            ? $toolboxMeeting->kehadiran
                            : json_decode($toolboxMeeting->kehadiran ?? '[]', true);
                    @endphp

                    <div class="mb-3">
                        <label class="form-label">Kehadiran</label>
                        @forelse ($listKehadiran as $nama)
                            <input type="text" class="form-control mb-2" value="{{ $nama }}" disabled>
                        @empty
                            <input type="text" class="form-control mb-2" value="(Tidak ada data kehadiran)" disabled>
                        @endforelse
                    </div>

                    @if($toolboxMeeting->status == 'unverified' && $toolboxMeeting->note)
                    <div class="alert alert-warning">
                        <h6 class="alert-heading fw-bold mb-1">Catatan SPV:</h6>
                        <p class="mb-0">{{ $toolboxMeeting->note }}</p>
                    </div>
                    @endif

                    {{-- Role-based PDF download access --}}
                    @if(auth()->user()->role === 'supervisor')
                        <a href="{{ route('toolbox-meetings.export-pdf', $toolboxMeeting->id) }}" target="_blank"
                            class="btn btn-danger">
                            Download PDF
                        </a>
                    @endif
                    <a href="{{ route('toolbox-meetings.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection

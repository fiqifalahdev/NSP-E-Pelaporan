@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Table Data HIRADC')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="ri-check-line me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="ri-check-line me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <!-- Tabel Data HIRADC -->
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header m-0">Daftar HIRADC</h5>
            <a href="{{ route('hiradc.create') }}" class="btn btn-primary me-4">
                <i class="ri-add-line me-1"></i> Tambah Data
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Lokasi</th>
                        <th>Aktivitas</th>
                        <th>Potensi Bahaya</th>
                        <th>Dampak Bahaya</th>
                        <th>PIC</th>
                        <th>Nilai Risiko Awal</th>
                        <th>Rekomendasi</th>
                        <th>Nilai Risiko Akhir</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($hiradcs as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->identifikasi_lokasi }}</td>
                            <td>{{ $item->identifikasi_aktifitas }}</td>
                            <td>{{ $item->identifikasi_potensi_bahaya }}</td>
                            <td>{{ $item->identifikasi_dampak_bahaya }}</td>
                            <td>{{ $item->identifikasi_PIC }}</td>
                            @if ($item->control_nilai_resiko < 4)
                                <td>
                                    <span class="badge bg-label-success">
                                        Rendah
                                    </span>
                                </td>
                            @elseif ($item->control_nilai_resiko >= 4 && $item->control_nilai_resiko < 8)
                                <td>
                                    <span class="badge bg-label-warning">
                                        Sedang
                                    </span>
                                </td>
                            @elseif ($item->control_nilai_resiko >= 8 && $item->control_nilai_resiko < 12)
                                <td>
                                    <span class="badge bg-label-danger">
                                        Tinggi
                                    </span>
                                </td>
                            @elseif ($item->control_nilai_resiko >= 12)
                                <td>
                                    <span class="badge bg-label-danger">
                                        Sangat Tinggi
                                    </span>
                                </td>
                            @endif
                            {{-- <td>{{ $item->control_nilai_resiko }}</td> --}}
                            <td>{{ $item->recom_uraian }}</td>
                            @if ($item->recom_nilai_resiko < 4)
                                <td>
                                    <span class="badge bg-label-success">
                                        Rendah
                                    </span>
                                </td>
                            @elseif ($item->recom_nilai_resiko >= 4 && $item->recom_nilai_resiko < 8)
                                <td>
                                    <span class="badge bg-label-warning">
                                        Sedang
                                    </span>
                                </td>
                            @elseif ($item->recom_nilai_resiko >= 8 && $item->recom_nilai_resiko < 12)
                                <td>
                                    <span class="badge bg-label-danger">
                                        Tinggi
                                    </span>
                                </td>
                            @elseif ($item->recom_nilai_resiko >= 12)
                                <td>
                                    <span class="badge bg-label-danger">
                                        Sangat Tinggi
                                    </span>
                                </td>
                            @endif
                            {{-- <td>{{ $item->recom_nilai_resiko }}</td> --}}
                            <td>
                                @if ($item->status == 'verified')
                                    <span class="badge bg-label-primary me-1">Terverifikasi</span>
                                @endif

                                @if ($item->status == 'unverified')
                                    <span class="badge bg-label-secondary me-1">Verifikasi Ditolak</span>
                                @endif

                                @if ($item->status == 'waiting')
                                    <span class="badge bg-label-info me-1">Menunggu Verifikasi</span>
                                @endif
                            </td>
                            <td class="d-flex gap-1">
                                @if (
                                    !in_array($item->status, ['verified', 'unverified']) &&
                                        in_array(auth()->user()->role, ['admin', 'supervisor', 'manager']))
                                    <form action="{{ route('hiradc.verify', $item->id) }}" method="post">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-sm btn-success"onclick="return confirm('Yakin ingin memverifikasi data ini?')">Verify
                                        </button>
                                    </form>

                                    <form action="{{ route('hiradc.reject', $item->id) }}" method="post">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-sm btn-warning"onclick="return confirm('Yakin ingin mereject data ini?')">Reject
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('hiradc.show', $item->id) }}" class="btn btn-sm btn-info">Lihat</a>

                                @if (auth()->user()->role == 'supervisor' || auth()->user()->role == 'manager' || auth()->user()->role == 'admin')
                                    {{-- Tombol Edit dan Hapus hanya untuk Supervisor, Manager, dan Admin --}}
                                    <a href="{{ route('hiradc.edit', $item->id) }}"
                                        class="btn btn-sm btn-secondary">Edit</a>
                                    <form action="{{ route('hiradc.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                    <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-5 px-4">
                {{ $hiradcs->links() }}
            </div>
        </div>
    </div>
    <!--/ Tabel Data HIRADC -->
@endsection

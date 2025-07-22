@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Tabel Data Safety Patrol')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="ri-check-line me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="ri-close-line me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabel Data Safety Patrol -->
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header m-0">Data Safety Patrol</h5>
            <a href="{{ route('safety-patrol.create') }}" class="btn btn-primary me-4">
                <i class="ri-add-line me-1"></i> Tambah Data
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kriteria</th>
                        <th>Lokasi</th>
                        <th>Temuan</th>
                        <th>Tanggal</th>
                        <th>Kesesuaian</th>
                        <th>Status</th>
                        <th>Catatan SPV</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($safetyPatrols as $i => $item)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $item->kriteria }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>
                                <span
                                    class="badge bg-label-{{ $item->temuan === 'Unsafe Action' ? 'warning' : ($item->temuan === 'Safe' ? 'success' : 'danger') }}">
                                    {{ $item->temuan }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td>
                                <span class="badge bg-label-{{ $item->kesesuaian === 'Baik' ? 'success' : 'danger' }}">
                                    {{ $item->kesesuaian }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-label-{{ $item->status == 'verified' ? 'primary' : ($item->status == 'unverified' ? 'secondary' : 'info') }} me-1">
                                    {{ $item->status == 'verified' ? 'Terverifikasi' : ($item->status == 'unverified' ? 'Verifikasi Ditolak' : 'Menunggu Verifikasi') }}
                                </span>
                            </td>
                            <td style="width: 300px; word-wrap: break-word;">{{ $item->note }}</td>
                            <td class="d-flex gap-1">
                                @if (!in_array($item->status, ['verified', 'unverified']) && in_array(auth()->user()->role, ['supervisor', 'manager']))
                                    <form action="{{ route('safety-patrol.verify', $item->id) }}" method="post">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-sm btn-success" onclick="return confirm('Yakin ingin memverifikasi data ini?')">Verify
                                        </button>
                                    </form>

                                    @if(auth()->user()->role == 'supervisor')
                                    <form action="{{ route('safety-patrol.reject', $item->id) }}" method="post">
                                        @csrf
                                        <button type="button"
                                            class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $item->id }}">Reject
                                        </button>
                                    </form>
                                    
                                    <!-- Reject Modal -->
                                    <div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="rejectModalLabel{{ $item->id }}">Reject Safety Patrol</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('safety-patrol.reject', $item->id) }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="note" class="form-label">Alasan Reject</label>
                                                            <textarea class="form-control" id="note" name="note" rows="3" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-warning">Reject</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endif

                                <a href="{{ route('safety-patrol.show', $item->id) }}"
                                    class="btn btn-sm btn-info">Lihat</a>

                                @if (auth()->user()->role == 'supervisor' || auth()->user()->role == 'manager' || auth()->user()->role == 'admin')
                                    <a href="{{ route('safety-patrol.edit', $item->id) }}"
                                        class="btn btn-sm btn-secondary">Edit</a>
                                    <form action="{{ route('safety-patrol.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Data tidak tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-5 px-4">
                {{ $safetyPatrols->links() }}
            </div>
        </div>
    </div>
    <!--/ Tabel Data Safety Patrol -->
@endsection

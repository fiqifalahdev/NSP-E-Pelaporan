@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar Toolbox Meeting')

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

    <!-- Tabel Data Toolbox Meeting -->
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header m-0">Daftar Toolbox Meeting</h5>
            <a href="{{ route('toolbox-meetings.create') }}" class="btn btn-primary me-4">
                <i class="ri-add-line me-1"></i> Tambah Data
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Penanggung Jawab</th>
                        <th>Jabatan</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php $i = 0; @endphp
                    @forelse ($meetings as $meeting)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ \Carbon\Carbon::parse($meeting->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $meeting->penanggung_jawab }}</td>
                            <td>{{ $meeting->jabatan }}</td>
                            <td>{{ Str::limit($meeting->keterangan, 50) }}</td>
                            <td>
                                @if ($meeting->status == 'closed')
                                    <span class="badge bg-label-danger">Closed</span>
                                @else
                                    <span class="badge bg-label-success">Open</span>
                                @endif
                            </td>
                            <td class="d-flex gap-1">
                                @if ((auth()->user()->role == 'supervisor' || auth()->user()->role == 'manager' || auth()->user()->role == 'admin' ) && $meeting->status == 'open')
                                    <form action="{{ route('toolbox-meetings.changeStatus', $meeting->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah meeting berikut sudah closed?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning">Update Status</button>
                                    </form>
                                @endif

                                <a href="{{ route('toolbox-meetings.show', $meeting->id) }}"
                                    class="btn btn-sm btn-info">Lihat</a>

                                @if (auth()->user()->role == 'supervisor' || auth()->user()->role == 'manager' || auth()->user()->role == 'admin')
                                    <a href="{{ route('toolbox-meetings.edit', $meeting->id) }}"
                                        class="btn btn-sm btn-secondary">Edit</a>

                                    <form action="{{ route('toolbox-meetings.destroy', $meeting->id) }}" method="POST"
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
                            <td colspan="6" class="text-center text-muted">Belum ada data Toolbox Meeting.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5 px-4">
            {{ $meetings->links() }}
        </div>
    </div>
    <!--/ Tabel Data Toolbox Meeting -->
@endsection

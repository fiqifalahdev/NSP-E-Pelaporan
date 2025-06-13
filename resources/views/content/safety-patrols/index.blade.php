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
                            <td class="d-flex gap-1">
                                <a href="{{ route('safety-patrol.show', $item->id) }}"
                                    class="btn btn-sm btn-info">Lihat</a>

                                @if (auth()->user()->role == 'supervisor' || auth()->user()->role == 'manager' || auth()->user()->role == 'admin')
                                    <a href="{{ route('safety-patrol.edit', $item->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
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
                            <td colspan="7" class="text-center">Data tidak tersedia.</td>
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

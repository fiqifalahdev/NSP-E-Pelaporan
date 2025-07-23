@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Table Data Akun Pengguna')

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


    <!-- Tabel Data user -->
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header m-0">Daftar Akun User</h5>
            <a href="{{ route('users.create') }}" class="btn btn-primary me-4">
                <i class="ri-add-line me-1"></i> Tambah Data
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($users as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @if ($item->role == 'admin')
                                    <span class="badge bg-label-primary me-1">Admin</span>
                                @elseif ($item->role == 'user')
                                    <span class="badge bg-label-secondary me-1">Safetyman</span>
                                @elseif ($item->role == 'supervisor')
                                    <span class="badge bg-label-success me-1">Supervisor</span>
                                @elseif ($item->role == 'manager')
                                    <span class="badge bg-label-success me-1">Manager</span>
                                @else
                                    <span class="badge bg-label-danger me-1">Unknown Role</span>
                                @endif
                            </td>
                            <td class="d-flex gap-1">
                                <a href="{{ route('users.show', $item->id) }}" class="btn btn-sm btn-info">Lihat</a>
                                <a href="{{ route('users.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('users.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>

                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                    <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Tabel Data user -->
@endsection

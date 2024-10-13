@extends('layouts.admin.main')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Distributor</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                </div>
            </div>

            <div class="section-body">
                <div class="row mb-4">
                    <div class="col">
                        <a href="{{ route('distributor.create') }}" class="btn btn-primary">Tambah Distributor</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>List Distributor</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Distributor</th>
                                            <th>Lokasi</th>
                                            <th>Kontak</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($distributors as $distributor)
                                            <tr>
                                                <td>{{ $distributor->nama_distributor }}</td>
                                                <td>{{ $distributor->lokasi }}</td>
                                                <td>{{ $distributor->kontak }}</td>
                                                <td>{{ $distributor->email }}</td>
                                                <td>
                                                    <!-- Tombol aksi dengan warna berbeda -->
                                                    <div class="d-flex justify-content-between">
                                                    <a href="{{ route('distributor.edit', $distributor->id) }}" class="btn btn-sm btn-warning mr-2" title="Edit Distributor">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <a href="{{ route('distributor.detail', $distributor->id) }}" class="btn btn-sm btn-info mr-2" title="Detail Distributor">
                                                        <i class="fas fa-info-circle"></i> Detail
                                                    </a>
                                                    <form action="{{ route('distributor.destroy', $distributor->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Distributor" onclick="return confirm('Apakah Anda yakin ingin menghapus distributor ini?')">
                                                            <i class="fas fa-trash-alt"></i> Hapus
                                                        </button>
                                                    </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Daftar Pelanggan')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📋 Daftar Pelanggan</h2>

    <a href="{{ url('/pelanggan/create') }}" class="btn btn-primary mb-3">+ Tambah Pelanggan</a>

    <div class="card shadow">
        <div class="card-body p-0">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Keluhan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggan as $pelanggan)
                    <tr>
                        <td>{{ $pelanggan['id'] }}</td>
                        <td>{{ $pelanggan['nama'] }}</td>
                        <td>{{ $pelanggan['keluhan'] }}</td>
                        <td>
                            <a href="{{ url('/pelanggan/'.$pelanggan['id']) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ url('/pelanggan/'.$pelanggan['id'].'/edit') }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                            <a href="{{ url('/pelanggan/'.$pelanggan['id'].'/delete') }}" class="btn btn-danger btn-sm">🗑️ Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

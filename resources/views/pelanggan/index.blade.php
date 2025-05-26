@extends('layouts.app')

@section('title', 'Daftar Pelanggan')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">Daftar Pelanggan</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ url('/pelanggan/create') }}" class="btn btn-primary">+ Tambah Pelanggan</a>

    <form action="{{ url('/pelanggan') }}" method="GET" class="form-inline">
      <input type="text" name="search" class="form-control mr-2" placeholder="Cari Pelanggan" value="{{ request('search') }}">
      <button type="submit" class="btn btn-outline-secondary">Cari</button>
    </form>
  </div>

  <div class="card shadow" style="max-height: 500px; overflow-y: auto;">
    <div class="card-body p-0">
      <table class="table table-bordered table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Keluhan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($pelanggan as $p)
          <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->keluhan }}</td>
            <td>
              <a href="{{ url('/pelanggan/'.$p->id) }}" class="btn btn-info btn-sm">Detail</a>
              <a href="{{ url('/pelanggan/'.$p->id.'/edit') }}" class="btn btn-warning btn-sm">Edit</a>
              <a href="{{ url('/pelanggan/'.$p->id.'/delete') }}" class="btn btn-danger btn-sm">Hapus</a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4" class="text-center">Data tidak ditemukan.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Daftar Pelanggan')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">Daftar Pelanggan</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ url('/pelanggan/create') }}" class="btn btn-primary mb-3">+ Tambah Pelanggan</a>

  <div class="card shadow">
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
          @foreach ($pelanggan as $p)
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
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
<div class="container mt-4">
  <div class="card">
    <div class="card-header">Tambah Pelanggan</div>
    <div class="card-body">
      <form action="{{ url('/pelanggan') }}">
        @csrf
        <div class="mb-3">
          <label>Nama</label>
          <input type="text" name="nama_pelanggan" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>No. Telepon</label>
          <input type="text" name="no_telepon" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Keluhan</label>
          <textarea name="keluhan" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ url('/pelanggan') }}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
@endsection

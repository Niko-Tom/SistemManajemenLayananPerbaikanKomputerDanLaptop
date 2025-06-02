@extends('layouts.app')

@section('title', 'Edit Layanan')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">Edit Layanan</h2>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('layanan.update', $layanan->id_layanan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label">Nama Pelanggan</label>
          <input type="text" class="form-control" value="{{ $layanan->pelanggan->nama }}" readonly>
        </div>

        <div class="mb-3">
          <label for="jenis_kerusakan" class="form-label">Jenis Kerusakan</label>
          <input type="text" name="jenis_kerusakan" class="form-control" value="{{ $layanan->jenis_kerusakan }}" required>
        </div>

        <div class="mb-3">
          <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
          <input type="date" name="tanggal_masuk" class="form-control" value="{{ $layanan->tanggal_masuk }}" required>
        </div>

        <div class="mb-3">
          <label for="catatan" class="form-label">Catatan</label>
          <textarea name="catatan" class="form-control" rows="3">{{ $layanan->catatan }}</textarea>
        </div>

        <div class="mb-3">
          <label for="harga" class="form-label">Harga</label>
          <input type="number" name="harga" class="form-control" value="{{ $layanan->harga }}" min="0" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('layanan.index') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
@endsection

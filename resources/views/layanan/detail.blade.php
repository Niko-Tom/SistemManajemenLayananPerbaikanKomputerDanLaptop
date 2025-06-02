@extends('layouts.app')

@section('title', 'Detail Layanan')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">Detail Layanan</h2>
  <div class="card">
    <div class="card-body">
      <h5><strong>Nama Pelanggan:</strong> {{ $layanan->pelanggan->nama }}</h5>
      <p><strong>ID Layanan:</strong> {{ $layanan->id_layanan }}</p>
      <p><strong>Jenis Kerusakan:</strong> {{ $layanan->jenis_kerusakan }}</p>
      <p><strong>Tanggal Masuk:</strong> {{ $layanan->tanggal_masuk }}</p>
      <p><strong>Catatan:</strong> {{ $layanan->catatan }}</p>
      <p><strong>Harga:</strong> Rp{{ number_format($layanan->harga, 0, ',', '.') }}</p>
      <a href="{{ route('layanan.index') }}" class="btn btn-secondary">← Kembali</a>
      <a href="{{ url('/layanan/'.$layanan->id_layanan.'/edit') }}" class="btn btn-m btn-warning">Edit</a>
    </div>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container mt-4">
  <div class="card">
    <div class="card-header">
      <h3><i class="fas fa-file-invoice"></i> Detail Transaksi</h3>
    </div>
    <div class="card-body">
      <p><strong>ID Detail:</strong> {{ $detail->id_detail }}</p>
      <p><strong>ID Transaksi:</strong> {{ $detail->id_transaksi }}</p>
      <p><strong>Nama Pelanggan:</strong> {{ $detail->transaksi->pelanggan->nama ?? '-' }}</p>
      <p><strong>Keterangan:</strong></p>
      <div class="border p-3 rounded bg-light">{{ $detail->keterangan }}</div>

      <a href="{{ url('/detailTransaksi') }}" class="btn btn-secondary mt-4">← Kembali</a>
    </div>
  </div>
</div>
@endsection

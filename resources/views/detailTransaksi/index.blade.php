@extends('layouts.app')

@section('title', 'Daftar Detail Transaksi')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">Daftar Detail Transaksi</h2>

  <div class="d-flex justify-content-end mb-3">
    <form action="{{ url('/detailTransaksi') }}" method="GET" class="form-inline">
      <input type="text" name="search" class="form-control mr-2" placeholder="Cari ID Transaksi / Pelanggan" value="{{ request('search') }}">
      <button type="submit" class="btn btn-outline-secondary">Cari</button>
    </form>
  </div>

  <div class="row">
    @foreach ($detailTransaksi as $d)
    <div class="col-md-4 col-sm-6 mb-4">
      <div class="info-box shadow">
        <span class="info-box-icon bg-success"><i class="fas fa-receipt"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">ID Transaksi: {{ $d->id_transaksi }}</span>
          <span class="info-box-number">ID Detail: {{ $d->id_detail }}</span>
          <span class="text-muted">Klik tombol di bawah untuk melihat rincian atau mengedit keterangan.</span>
          <div class="mt-2">
            <a href="{{ url('/detailTransaksi/'.$d->id_detail) }}" class="btn btn-sm btn-info">Detail</a>
            <a href="{{ url('/detailTransaksi/'.$d->id_detail.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection

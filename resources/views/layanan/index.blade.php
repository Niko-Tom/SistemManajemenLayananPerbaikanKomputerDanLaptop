@extends('layouts.app')

@section('title', 'Daftar Layanan')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">Daftar Layanan</h2>

  {{-- FORM CARI --}}
  <div class="d-flex justify-content-end mb-3">
    <form action="{{ url('/layanan') }}" method="GET" class="form-inline">
      <input type="text" name="search" class="form-control mr-2" placeholder="Cari Layanan / Pelanggan" value="{{ request('search') }}">
      <button type="submit" class="btn btn-outline-secondary">Cari</button>
    </form>
  </div>

  <div class="row">
    @foreach ($layanan as $index => $l)
    @php
      $progress = [30, 45, 60, 75, 90, 100];
      $percent = $progress[$index % count($progress)];
      $status = $percent < 100 ? 'Proses' : 'Selesai';
    @endphp
    <div class="col-md-4 col-sm-6 mb-4">
      <div class="info-box shadow">
        <span class="info-box-icon bg-info"><i class="fas fa-laptop"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">ID Layanan: {{ $l->id_layanan }}</span>
          <span class="info-box-number">ID Pelanggan: {{ $l->id_pelanggan }}</span>
          <div class="progress">
            <div class="progress-bar bg-success" style="width: {{ $percent }}%"></div>
          </div>
          <span class="progress-description">{{ $status }} ({{ $percent }}%)</span>
          <div class="mt-2">
            <a href="{{ url('/layanan/'.$l->id_layanan) }}" class="btn btn-sm btn-info">Detail</a>
            <a href="{{ url('/layanan/'.$l->id_layanan.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection

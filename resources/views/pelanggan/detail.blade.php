@extends('layouts.app')

@section('title', 'Detail Pelanggan')

@section('content')
<div class="container mt-4">
  <h2>Detail Pelanggan</h2>
  <div class="card">
    <div class="card-body">
      <h3 class="card-title">{{ $pelanggan->nama }}</h3><hr>
      <p><strong>Email:</strong> {{ $pelanggan->email }}</p>
      <p><strong>Telepon:</strong> {{ $pelanggan->telepon }}</p>
      <p><strong>Keluhan:</strong> {{ $pelanggan->keluhan }}</p>

      <a href="{{ url('/pelanggan') }}" class="btn btn-secondary">← Kembali</a>
      <a href="{{ url('/pelanggan/'.$pelanggan->id.'/edit') }}" class="btn btn-warning">Edit</a>
      <a href="{{ url('/pelanggan/'.$pelanggan->id.'/delete') }}" class="btn btn-danger">Hapus</a>
    </div>
  </div>
</div>
@endsection

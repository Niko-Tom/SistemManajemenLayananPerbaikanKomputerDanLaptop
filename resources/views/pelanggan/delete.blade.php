@extends('layouts.app')

@section('title', 'Konfirmasi Hapus')

@section('content')
<div class="container mt-4">
  <h2>Hapus Pelanggan</h2>
  <div class="alert alert-danger">
    Yakin ingin menghapus pelanggan <strong>{{ $pelanggan->nama }}</strong>?
  </div>
  
  <form action="{{ url('/pelanggan/' . $pelanggan->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
    <a href="{{ url('/pelanggan') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection

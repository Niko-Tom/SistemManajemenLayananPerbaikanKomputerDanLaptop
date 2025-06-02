@extends('layouts.app')

@section('title', 'Edit Detail Transaksi')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">Edit Detail Transaksi</h2>
  <div class="card">
    <div class="card-body">
      <form action="{{ url('/detailTransaksi/'.$detail->id_detail) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label">ID Transaksi</label>
          <input type="text" class="form-control" value="{{ $detail->id_transaksi }}" readonly>
        </div>

        <div class="mb-3">
          <label for="keterangan" class="form-label">Keterangan</label>
          <textarea name="keterangan" class="form-control" rows="4" required>{{ $detail->keterangan }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ url('/detailTransaksi') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
@endsection

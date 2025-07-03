@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
<!-- Content Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Transaksi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/transaksi') }}">Transaksi</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="card">
        <div class="card-header bg-primary text-white">
          <h3 class="card-title">Form Edit Transaksi</h3>
        </div>
        <div class="card-body">
          <form action="{{ url('/transaksi/' . $transaksi->id_transaksi) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label>ID Transaksi</label>
              <input type="text" class="form-control" value="{{ $transaksi->id_transaksi }}" disabled>
            </div>

            <div class="mb-3">
              <label>Nama Pelanggan</label>
              <input type="text" class="form-control" value="{{ $transaksi->pelanggan->nama }}" disabled>
            </div>

            <div class="mb-3">
              <label>Jenis Kerusakan</label>
              <input type="text" class="form-control" value="{{ $transaksi->layanan->jenis_kerusakan }}" disabled>
            </div>

            <div class="mb-3">
              <label>Tanggal Masuk</label>
              <input type="text" class="form-control" value="{{ $transaksi->layanan->tanggal_masuk }}" disabled>
            </div>

            <div class="mb-3">
              <label for="id_admin">Petugas</label>
              <select name="id_admin" id="id_admin" class="form-control" required>
                @foreach ($adminStaff as $a)
                  <option value="{{ $a->id_admin }}" {{ old('id_admin', $transaksi->id_admin) == $a->id_admin ? 'selected' : '' }}>
                    {{ $a->nama_admin }} ({{ $a->id_admin }})
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="total_harga">Total Harga</label>
              <input type="number" name="total_harga" class="form-control" value="{{ old('total_harga', $transaksi->total_harga) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ url('/transaksi') }}" class="btn btn-secondary">Kembali</a>
          </form>
        </div>
      </div>

    </div>
  </section>
@endsection

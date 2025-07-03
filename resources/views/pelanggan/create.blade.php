@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
<div class="container mt-4">
  <div class="card">
    <div class="card-header">Tambah Pelanggan</div>
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <form action="{{ url('/pelanggan') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
          <label for="telepon" class="form-label">No. Telepon</label>
          <input type="text" name="telepon" id="telepon" class="form-control" value="{{ old('telepon') }}" required>
        </div>
        <div class="mb-3">
          <label for="keluhan" class="form-label">Keluhan</label>
          <textarea name="keluhan" id="keluhan" class="form-control" rows="3" required>{{ old('keluhan') }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ url('/pelanggan') }}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
@endsection

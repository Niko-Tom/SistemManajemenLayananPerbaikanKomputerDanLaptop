@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">Edit Pelanggan</div>
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
      <form method="POST" action="{{ url('/pelanggan/' . $pelanggan->id) }}">
      @csrf
      @method('PUT') {{-- Sangat penting untuk override POST ke PUT --}}

          <div class="mb-3">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" value="{{ old('nama', $pelanggan->nama) }}" required>
          </div>

          <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" value="{{ old('email', $pelanggan->email) }}" required>
          </div>

          <div class="mb-3">
              <label>No. Telepon</label>
              <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $pelanggan->telepon) }}" required>
          </div>

          <div class="mb-3">
              <label>Keluhan</label>
              <textarea name="keluhan" class="form-control" required>{{ old('keluhan', $pelanggan->keluhan) }}</textarea>
          </div>

          <button type="submit" class="btn btn-primary">Update</button>
          <a href="{{ url('/pelanggan') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
@endsection


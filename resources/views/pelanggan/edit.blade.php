@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">Edit Pelanggan</div>
    <div class="card-body">
      
      <form method="POST" action="{{ url('/pelanggan/' . $pelanggan->id) }}">
      @csrf
      @method('PUT') {{-- Sangat penting untuk override POST ke PUT --}}

          <div class="mb-3">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" value="{{ $pelanggan->nama }}" required>
          </div>

          <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" value="{{ $pelanggan->email }}" required>
          </div>

          <div class="mb-3">
              <label>No. Telepon</label>
              <input type="text" name="telepon" class="form-control" value="{{ $pelanggan->telepon }}" required>
          </div>

          <div class="mb-3">
              <label>Keluhan</label>
              <textarea name="keluhan" class="form-control" required>{{ $pelanggan->keluhan }}</textarea>
          </div>

          <button type="submit" class="btn btn-primary">Update</button>
          <a href="{{ url('/pelanggan') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
@endsection


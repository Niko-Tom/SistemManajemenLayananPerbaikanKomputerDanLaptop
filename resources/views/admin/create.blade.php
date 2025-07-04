@extends('layouts.app')

@section('title', 'Tambah Admin')

@section('content')
<div class="container mt-4">
  <div class="card">
    <div class="card-header">Tambah Admin</div>
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
      <form action="{{ url('/admin') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="nama_admin" class="form-label">Nama Admin</label>
          <input type="text" name="nama_admin" id="nama_admin" class="form-control" value="{{ old('nama_admin') }}" required>
        </div>
        <div class="mb-3">
          <label for="kontak" class="form-label">Kontak</label>
          <input type="text" name="kontak" id="kontak" class="form-control" value="{{ old('kontak') }}" required>
        </div>
        <div class="mb-3">
          <label for="role" class="form-label">Role</label>
          <select name="role" id="role" class="form-control" required>
            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
            <option value="Manager" {{ old('role') == 'Manager' ? 'selected' : '' }}>Manager</option>
            <option value="Staff" {{ old('role') == 'Staff' ? 'selected' : '' }}>Staff</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ url('/admin') }}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Edit Admin')

@section('content')
<div class="container mt-4">
  <div class="card">
    <div class="card-header">Edit Admin</div>
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
      <form method="POST" action="{{ url('/admin/' . $admin->id_admin) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="nama_admin" class="form-label">Nama Admin</label>
          <input type="text" name="nama_admin" class="form-control" value="{{ old('nama_admin', $admin->nama_admin) }}" required>
        </div>

        <div class="mb-3">
          <label for="kontak" class="form-label">Kontak</label>
          <input type="text" name="kontak" class="form-control" value="{{ old('kontak', $admin->kontak) }}" required>
        </div>

        <div class="mb-3">
          <label for="role" class="form-label">Role</label>
          <select name="role" class="form-control" required>
            <option value="Admin" {{ old('role', $admin->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
            <option value="Manager" {{ old('role', $admin->role) == 'Manager' ? 'selected' : '' }}>Manager</option>
            <option value="Staff" {{ old('role', $admin->role) == 'Staff' ? 'selected' : '' }}>Staff</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ url('/admin') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Detail Admin')

@section('content')
@php
  // Array nama file gambar
  $photos = ['user1-128x128.jpg', 'user2-160x160.jpg', 'user3-128x128.jpg', 'user4-128x128.jpg', 'user5-128x128.jpg', 'user6-128x128.jpg', 'user7-128x128.jpg', 'user8-128x128.jpg', 'photo3.jpg'];
  $randomPhoto = $photos[$admin->id_admin ? hexdec(substr(md5($admin->id_admin), 0, 2)) % count($photos) : rand(0, count($photos)-1)];
@endphp

<div class="container mt-4">
  <h2 class="mb-4">Detail Admin</h2>

  <div class="card shadow-sm">
    <div class="card-body row">
      <div class="col-md-8">
        <h4>{{ $admin->nama_admin }}</h4>
        <hr>
        <p><strong>ID Admin:</strong> {{ $admin->id_admin }}</p>
        <p><strong>Kontak:</strong> {{ $admin->kontak }}</p>

        <a href="{{ url('/admin') }}" class="btn btn-secondary">← Kembali</a>
        <a href="{{ url('/admin/'.$admin->id_admin.'/edit') }}" class="btn btn-warning">Edit</a>
      </div>
      <div class="col-md-4 text-center">
        <img src="{{ asset('dist/img/' . $randomPhoto) }}" alt="Foto Admin" class="img-thumbnail rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
        <p class="mt-2 text-muted">{{ $admin->nama_admin }}</p>
      </div>
    </div>
  </div>
</div>
@endsection

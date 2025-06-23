@extends('layouts.app')

@section('title', 'Upload Gambar')

@section('content')
<div class="container mt-4">
  <div class="card">
    <div class="card-header">Upload Gambar</div>
    <div class="card-body">

      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Judul:</label>
          <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="image" class="form-label">Pilih Gambar:</label>
          <input type="file" name="image" id="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Upload</button>
      </form>

      @if (isset($image))
      <hr>
      <h5>Gambar yang baru diupload:</h5>
      <p><strong>{{ $image->title }}</strong></p>
      <img src="{{ asset('storage/' . $image->image_path) }}" width="200" class="img-thumbnail">

      <form action="{{ route('image.delete', $image->id) }}" method="POST" class="mt-2">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Hapus Gambar</button>
      </form>
      @endif

    </div>
  </div>
</div>
@endsection

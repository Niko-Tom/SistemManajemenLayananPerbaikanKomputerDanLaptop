{{-- resources/views/errors/akses-ditolak.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <div class="card shadow p-4">
        <h1 class="text-danger"><i class="fas fa-exclamation-triangle"></i> Akses Ditolak</h1>
        <p class="mt-3">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
        <a href="{{ route('transaksi.index') }}" class="btn btn-primary mt-3">Kembali ke Transaksi</a>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', $pelanggan['nama'])

@section('content')
    <div class="container mt-4">
        <h2>Detail Pelanggan</h2>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $pelanggan['nama'] }}</h3><br><hr>
                <p class="card-text"><strong>Email:</strong> {{ $pelanggan['email'] }}</p>
                <p class="card-text"><strong>No. Telepon:</strong> {{ $pelanggan['telepon'] }}</p>
                <p class="card-text"><strong>Keluhan:</strong> {{ $pelanggan['keluhan'] }}</p>
                
                <a href="{{ url('/pelanggan') }}" class="btn btn-primary">← Kembali ke daftar</a>
            </div>
        </div>
    </div>
@endsection

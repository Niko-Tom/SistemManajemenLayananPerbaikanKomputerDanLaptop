@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
<!-- Content Header -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Transaksi</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active">Transaksi</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<!-- Main Content -->
<section class="content">
  <div class="container-fluid">
    
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search Form -->
    <div class="card mb-3">
      <div class="card-body">
        <form action="{{ url('/transaksi') }}" method="GET" class="form-inline">
          <input type="text" name="search" class="form-control mr-2" placeholder="Cari transaksi..." value="{{ request('search') }}">
          <button type="submit" class="btn btn-primary">Cari</button>
        </form>
      </div>
    </div>

    <!-- Data Table -->
    <div class="row">
      <div class="col-12">
        <div class="card shadow">
          <div class="card-header">
            <h3 class="card-title">Data Transaksi</h3>
          </div>
          <div class="card-body">
            <table id="transaksiTable" class="table table-bordered table-hover w-100">
              <thead>
                <tr>
                  <th>ID Transaksi</th>
                  <th>Nama Pelanggan</th>
                  <th>ID Layanan</th>
                  <th>Admin</th>
                  <th>Total Harga</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($transaksi as $t)
                  <tr>
                    <td>{{ $t->id_transaksi }}</td>
                    <td>{{ $t->pelanggan->nama ?? '-' }}</td>
                    <td>{{ $t->id_layanan }}</td>
                    <td>{{ $t->admin->nama_admin ?? '-' }}</td>
                    <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                    <td>
                      <a href="{{ url('/transaksi/'.$t->id_transaksi) }}" class="btn btn-sm btn-info">Detail</a>
                      <a href="{{ url('/transaksi/'.$t->id_transaksi.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div> <!-- /.card-body -->
        </div> <!-- /.card -->
      </div> <!-- /.col -->
    </div> <!-- /.row -->

  </div>
</section>
@endsection

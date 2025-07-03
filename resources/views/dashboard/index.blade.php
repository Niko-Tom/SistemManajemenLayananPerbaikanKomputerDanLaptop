@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
  <h2 class="mb-4">Dashboard Bro CompService</h2>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="row">
    <!-- Total Pelanggan -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ $totalPelanggan }}</h3>
          <p>Total Pelanggan</p>
        </div>
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
      </div>
    </div>

    <!-- Total Layanan -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $totalLayanan }}</h3>
          <p>Total Layanan</p>
        </div>
        <div class="icon">
          <i class="fas fa-laptop-medical"></i>
        </div>
      </div>
    </div>

    <!-- Total Transaksi -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ $totalTransaksi }}</h3>
          <p>Total Transaksi</p>
        </div>
        <div class="icon">
          <i class="fas fa-receipt"></i>
        </div>
      </div>
    </div>

    <!-- Total Admin -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{ $totalAdmin }}</h3>
          <p>Total Admin</p>
        </div>
        <div class="icon">
          <i class="fas fa-user-shield"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Progress -->
  <div class="row">
    <div class="col-md-6">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">Progress Pengerjaan Layanan</h3>
        </div>
        <div class="card-body">
          <p><strong>Selesai:</strong> {{ $layananSelesai }}</p>
          <div class="progress mb-3">
            <div class="progress-bar bg-success" role="progressbar"
              style="width: {{ $totalLayanan > 0 ? ($layananSelesai / $totalLayanan * 100) : 0 }}%">
              {{ round($totalLayanan > 0 ? ($layananSelesai / $totalLayanan * 100) : 0) }}%
            </div>
          </div>
          <p><strong>Belum Selesai:</strong> {{ $layananBelum }}</p>
        </div>
      </div>
    </div>

    <!-- Pie Chart Role Admin -->
    <div class="col-md-6">
      <div class="card card-danger card-outline">
        <div class="card-header">
          <h3 class="card-title">Distribusi Role Admin</h3>
        </div>
        <div class="card-body">
          <canvas id="rolePieChart" height="200"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Line Chart Pelanggan -->
  <div class="card card-outline card-info">
    <div class="card-header">
      <h3 class="card-title">Tren Pelanggan Baru (6 Bulan Terakhir)</h3>
    </div>
    <div class="card-body">
      <canvas id="pelangganChart" height="100"></canvas>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const roleChartCtx = document.getElementById('rolePieChart')?.getContext('2d');
  const rolePieChart = new Chart(roleChartCtx, {
    type: 'pie',
    data: {
      labels: {!! json_encode($roleCounts->keys()) !!},
      datasets: [{
        data: {!! json_encode($roleCounts->values()) !!},
        backgroundColor: ['#007bff', '#28a745', '#ffc107'],
      }]
    }
  });

  const pelangganChartCtx = document.getElementById('pelangganChart')?.getContext('2d');
  const pelangganChart = new Chart(pelangganChartCtx, {
    type: 'line',
    data: {
      labels: {!! json_encode($pelangganPerBulan->keys()) !!},
      datasets: [{
        label: 'Jumlah Pelanggan',
        data: {!! json_encode($pelangganPerBulan->values()) !!},
        backgroundColor: 'rgba(0,123,255,0.2)',
        borderColor: 'rgba(0,123,255,1)',
        borderWidth: 2,
        fill: true,
        tension: 0.3
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          precision: 0
        }
      }
    }
  });
</script>
@endpush

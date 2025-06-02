@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Invoice</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Invoice</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="callout callout-info">
          <h5><i class="fas fa-info"></i> Catatan:</h5>
          Halaman ini dapat dicetak. Klik tombol print di bagian bawah untuk mencetak invoice.
        </div>

        <div class="invoice p-3 mb-3">
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fas fa-laptop-code"></i> Bro CompServices
                <small class="float-right">Tanggal: {{ date('d/m/Y', strtotime($transaksi->created_at)) }}</small>
              </h4>
            </div>
          </div>

          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              Dari
              <address>
                <strong>{{ $transaksi->admin->nama_admin }}</strong><br>
                Telp: {{ $transaksi->admin->kontak }}<br>
                Email: admin@brocomp.id
              </address>
            </div>

            <div class="col-sm-4 invoice-col">
              Untuk
              <address>
                <strong>{{ $transaksi->pelanggan->nama }}</strong><br>
                Email: {{ $transaksi->pelanggan->email }}<br>
                Telepon: {{ $transaksi->pelanggan->telepon }}
              </address>
            </div>

            <div class="col-sm-4 invoice-col">
              <b>ID Transaksi:</b> {{ $transaksi->id_transaksi }}<br>
              <b>ID Layanan:</b> {{ $transaksi->id_layanan }}<br>
              <b>Jatuh Tempo:</b> {{ date('d/m/Y', strtotime($transaksi->created_at . ' +3 days')) }}<br>
              <b>Status:</b> <span class="badge badge-success">Lunas</span>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Qty</th>
                    <th>Deskripsi</th>
                    <th>Jenis Kerusakan</th>
                    <th>Catatan</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Layanan Servis</td>
                    <td>{{ $transaksi->layanan->jenis_kerusakan }}</td>
                    <td>{{ $transaksi->layanan->catatan }}</td>
                    <td>Rp {{ number_format($transaksi->layanan->harga, 0, ',', '.') }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <p class="lead">Metode Pembayaran:</p>
              <img src="{{ asset('dist/img/credit/visa.png') }}" alt="Visa">
              <img src="{{ asset('dist/img/credit/mastercard.png') }}" alt="Mastercard">
              <img src="{{ asset('dist/img/credit/paypal2.png') }}" alt="Paypal">

              <p class="text-muted well well-sm shadow-none mt-3">
                Terima kasih telah menggunakan layanan kami. Jika ada pertanyaan, silakan hubungi customer service kami.
              </p>
            </div>

            <div class="col-6">
              <p class="lead">Total yang Harus Dibayar</p>

              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th>Subtotal:</th>
                    <td>Rp {{ number_format($transaksi->layanan->harga, 0, ',', '.') }}</td>
                  </tr>
                  <tr>
                    <th>PPN (10%):</th>
                    <td>Rp {{ number_format($transaksi->layanan->harga * 0.10, 0, ',', '.') }}</td>
                  </tr>
                  <tr>
                    <th>Total:</th>
                    <td><strong>Rp {{ number_format($transaksi->layanan->harga * 1.10, 0, ',', '.') }}</strong></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>

          <div class="row no-print">
            <div class="col-12">
              <a href="javascript:window.print();" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
              <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                <i class="fas fa-download"></i> Generate PDF
              </button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection

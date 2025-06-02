@extends('layouts.app')

@section('title', 'Daftar Admin')

@section('content')
<section class="content">
  <div class="container-fluid">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
      <a href="{{ url('/admin/create') }}" class="btn btn-primary">+ Tambah Admin</a>
      <form action="{{ url('/admin') }}" method="GET" class="form-inline">
        <input type="text" name="search" class="form-control mr-2" placeholder="Cari Admin" value="{{ request('search') }}">
        <button type="submit" class="btn btn-outline-secondary">Cari</button>
      </form>
    </div>

    <div class="card card-solid">
      <div class="card-body pb-0">
        <div class="row">
          @php
            $photos = ['user1-128x128.jpg', 'user2-160x160.jpg', 'user3-128x128.jpg', 'user4-128x128.jpg', 'user5-128x128.jpg', 'user6-128x128.jpg', 'user7-128x128.jpg', 'user8-128x128.jpg', 'photo3.jpg'];
          @endphp

          @forelse ($admin as $a)
            @php
              $index = $a->id_admin ? hexdec(substr(md5($a->id_admin), 0, 2)) % count($photos) : rand(0, count($photos) - 1);
              $photo = $photos[$index];
            @endphp

            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Admin Sistem
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>{{ $a->nama_admin }}</b></h2>
                      <p class="text-muted text-sm"><b>ID: </b> {{ $a->id_admin }}</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small">
                          <span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                          {{ $a->kontak }}
                        </li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="{{ asset('dist/img/' . $photo) }}" alt="Foto Admin" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="{{ url('/admin/'.$a->id_admin) }}" class="btn btn-sm btn-info">
                      <i class="fas fa-user"></i> Detail
                    </a>
                    <a href="{{ url('/admin/'.$a->id_admin.'/edit') }}" class="btn btn-sm btn-warning">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ url('/admin/'.$a->id_admin) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <div class="col-12">
              <p class="text-center text-muted">Data admin tidak ditemukan.</p>
            </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

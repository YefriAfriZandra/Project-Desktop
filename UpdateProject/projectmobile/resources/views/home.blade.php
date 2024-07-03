@extends('layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Home</h1>
  </div>
  <div class="container my-4">
    <div class="row" >
      @foreach ($pengumumans as $item)
        <div class="col-lg-4 my-4 ">
            <div class="card h-100">
                <img src="{{ asset('assets/Rapat.png') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->judul }}</h5>
                    <p class="card-text">{{ $item->deskripsi }}</p>
                    {{-- <a href="#" class="btn btn-dark">Read More</a> --}}
                </div>
            </div>
        </div>
      @endforeach
      {{ $pengumumans->links() }}
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Jumlah Siswa</h5>
                <p class="card-text">{{ $jumlahSiswa }}</p>
            </div>
            <div class="card-footer">
                <i class="fas fa-user"></i> Siswa
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Jumlah Guru</h5>
                <p class="card-text">{{ $jumlahGuru }}</p>
            </div>
            <div class="card-footer">
                <i class="fas fa-chalkboard-teacher"></i> Guru
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5 class="card-title">Jumlah Kelas</h5>
                <p class="card-text">{{ $jumlahKelas }}</p>
            </div>
            <div class="card-footer">
                <i class="fas fa-school"></i> Kelas
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.main')

@section('container')
<div class="col-lg-6 mb-5">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Entri Kelas</h1>
</div>
<form method="post" action="/routeKelas" enctype="multipart/form-data">
    @csrf

    <div class="mb-2">
      <label for="nama_kelas" class="form-label">Nama Kelas</label>
      <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror" name="nama_kelas" value="{{ old('nama_kelas')}}">
      @error('nama_kelas')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>
      
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection
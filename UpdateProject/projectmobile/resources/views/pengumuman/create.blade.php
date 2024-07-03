@extends('layouts.main')

@section('container')
<div class="col-lg-6 mb-5">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Entri Pengumuman</h1>
</div>
<form method="post" action="/pengumuman" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">

    <div class="mb-2">
      <label for="judul" class="form-label">Judul</label>
      <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul')}}">
      @error('judul')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
      @error('deskripsi')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="penerima" class="form-label">Penerima</label>
      <select class="form-select @error('penerima') is-invalid @enderror" name="penerima">
          <option value="" disabled selected>Pilih Penerima Pengumuman</option>
          <option value="1" {{ old('penerima') == '1' ? 'selected' : '' }}>Siswa</option>
          <option value="2" {{ old('penerima') == '2' ? 'selected' : '' }}>Guru</option>
          <option value="3" {{ old('penerima') == '3' ? 'selected' : '' }}>Semua</option>
      </select>
      @error('penerima')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="tgl_awal" class="form-label">Tanggal Awal Pengumuman</label>
      <input type="date" class="form-control @error('tgl_awal') is-invalid @enderror" name="tgl_awal" value="{{ old('tgl_awal')}}">
      @error('tgl_awal')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
      <input type="date" class="form-control @error('tgl_akhir') is-invalid @enderror" name="tgl_akhir" value="{{ old('tgl_akhir')}}">
      @error('tgl_akhir')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>
      
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection
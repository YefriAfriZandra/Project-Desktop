@extends('layouts.main')

@section('container')
<div class="col-lg-6 mb-5">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Entri Jenis Komite</h1>
</div>
<form method="post" action="/jenisKomite" enctype="multipart/form-data">
    @csrf

    <div class="mb-2">
      <label for="type" class="form-label">Tipe</label>
      <select name="type" class="form-select @error('type') is-invalid @enderror">
          <option value="" disabled selected>Pilih Pekerjaan</option>
          <option value="1">Pegawai Negeri</option>
          <option value="2">Pegawai Swasta</option>
          <option value="3">Wiraswasta</option>
          <option value="4">Pensiunan</option>
          <option value="5">Pelajar/Mahasiswa</option>
          <option value="6">Pekerja Lepas</option>
          <option value="7">Ibu Rumah Tangga</option>
          <option value="8">Tidak Bekerja</option>
          <option value="9">Lainnya</option>
      </select>
      @error('type')
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

    <div class="mb-3">
      <label for="biaya" class="form-label">Biaya</label>
      <input type="number" class="form-control @error('biaya') is-invalid @enderror" id="biaya" name="biaya" rows="4">{{ old('biaya') }}</textarea>
      @error('biaya')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
    </div>
      
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection
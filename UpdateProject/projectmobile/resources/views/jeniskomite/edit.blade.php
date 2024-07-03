@extends('layouts.main')

@section('container')
<div class="col-lg-6 mb-5">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Pelajaran</h1>
</div>
<form method="post" action="/jenisKomite/{{$jenis_komites->jenis_komite_id}}">
    @method('PUT')
    @csrf
  
    <div class="mb-2">
      <label for="type" class="form-label">Tipe</label>
      <input type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type', $jenis_komites->type)}}">
      @error('type')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $jenis_komites->deskripsi) }}</textarea>
      @error('deskripsi')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="biaya" class="form-label">Biaya</label>
      <input biaya="number" class="form-control @error('biaya') is-invalid @enderror" name="biaya" value="{{ old('biaya', $jenis_komites->biaya)}}">
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
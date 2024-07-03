@extends('layouts.main')

@section('container')
<div class="col-lg-6 mb-5">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Entri Pelajaran</h1>
  </div>
<form method="post" action="/pelajaran" enctype="multipart/form-data">
    @csrf

    <div class="mb-2">
      <label for="guru" class="form-label">Nama Guru</label>
      <select class="form-select @error('nip_guru') is-invalid @enderror" name="nip_guru">
        @foreach($gurus as $guru)
          @if(old('nip_guru')== $guru->nip_guru)
            <option value="{{$guru->nip_guru}}" selected>{{$guru->nama_guru}}</option>
          @else
            <option value="{{$guru->nip_guru}}">{{$guru->nama_guru}}</option>
          @endif
        @endforeach
      </select>
      @error('nip_guru')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="nama_pelajaran" class="form-label">Nama Pelajaran</label>
      <input type="text" class="form-control @error('nama_pelajaran') is-invalid @enderror" name="nama_pelajaran" value="{{ old('nama_pelajaran')}}">
      @error('nama_pelajaran')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>
      
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection
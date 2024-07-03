@extends('layouts.main')

@section('container')
<div class="col-lg-6 mb-5">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Nilai</h1>
</div>
<form method="post" action="/nilai/{{$nilais->nilai_id}}">
    @method('PUT')
    @csrf
  
    <div class="mb-2">
      <label for="nis" class="form-label">Nama Siswa</label>
      <select class="form-select @error('nis') is-invalid @enderror" name="nis">
        @foreach($siswas as $siswa)
          @if(old('nis', $nilais->nis)== $siswa->nis)
            <option value="{{$siswa->nis}}" selected>{{$siswa->nama_siswa}}</option>
          @else
            <option value="{{$siswa->nis}}">{{$siswa->nama_siswa}}</option>
          @endif
        @endforeach
      </select>
      @error('nis')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="pelajaran_id" class="form-label">Pelajaran</label>
      <select class="form-select @error('pelajaran_id') is-invalid @enderror" name="pelajaran_id">
        @foreach($pelajarans as $pelajaran)
          @if(old('pelajaran_id', $nilais->pelajaran_id)== $pelajaran->pelajaran_id)
            <option value="{{$pelajaran->pelajaran_id}}" selected>{{$pelajaran->nama_pelajaran}}</option>
          @else
            <option value="{{$pelajaran->pelajaran_id}}">{{$pelajaran->nama_pelajaran}}</option>
          @endif
        @endforeach
      </select>
      @error('pelajaran_id')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="nilai_kepribadian" class="form-label">Nilai Kepribadian</label>
      <select class="form-select @error('nilai_kepribadian') is-invalid @enderror" name="nilai_kepribadian">
          <option value="" disabled selected>Pilih Huruf</option>
          <option value="A" {{ old('nilai_kepribadian', $nilais->nilai_kepribadian) == 'A' ? 'selected' : '' }}>A</option>
          <option value="B" {{ old('nilai_kepribadian', $nilais->nilai_kepribadian) == 'B' ? 'selected' : '' }}>B</option>
          <option value="C" {{ old('nilai_kepribadian', $nilais->nilai_kepribadian) == 'C' ? 'selected' : '' }}>C</option>
          <option value="D" {{ old('nilai_kepribadian', $nilais->nilai_kepribadian) == 'D' ? 'selected' : '' }}>D</option>
          <option value="E" {{ old('nilai_kepribadian', $nilais->nilai_kepribadian) == 'E' ? 'selected' : '' }}>E</option>
      </select>
      @error('nilai_kepribadian')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="nilai_tugas" class="form-label">Nilai Tugas</label>
      <input type="number" step="0.01" class="form-control @error('nilai_tugas') is-invalid @enderror" name="nilai_tugas" value="{{ old('nilai_tugas', $nilais->nilai_tugas)}}">
      @error('nilai_tugas')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="nilai_uts" class="form-label">Nilai UTS</label>
      <input type="number" step="0.01" class="form-control @error('nilai_uts') is-invalid @enderror" name="nilai_uts" value="{{ old('nilai_uts', $nilais->nilai_uts)}}">
      @error('nilai_uts')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="nilai_uas" class="form-label">Nilai UAS</label>
      <input type="number" step="0.01" class="form-control @error('nilai_uas') is-invalid @enderror" name="nilai_uas" value="{{ old('nilai_uas', $nilais->nilai_uas)}}">
      @error('nilai_uas')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="sakit" class="form-label">Jumlah Sakit</label>
      <input type="number" class="form-control @error('sakit') is-invalid @enderror" name="sakit" value="{{ old('sakit', $nilais->sakit)}}">
      @error('sakit')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>
      
    <div class="mb-2">
      <label for="alfa" class="form-label">Jumlah Alfa</label>
      <input type="number" class="form-control @error('alfa') is-invalid @enderror" name="alfa" value="{{ old('alfa', $nilais->alfa)}}">
      @error('alfa')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="izin" class="form-label">Jumlah Izin</label>
      <input type="number" class="form-control @error('izin') is-invalid @enderror" name="izin" value="{{ old('izin', $nilais->izin)}}">
      @error('izin')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection
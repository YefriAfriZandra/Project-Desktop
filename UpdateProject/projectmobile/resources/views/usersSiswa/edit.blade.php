@extends('layouts.main')

@section('container')
<div class="col-lg-6 mb-5">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit User Siswa</h1>
</div>
<form method="post" action="/usersSiswa/{{ $siswas->nis }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
  
    <div class="mb-2">
      <label for="kelas" class="form-label">Kelas</label>
      <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id">
        @foreach($kelas as $item)
          @if(old('kelas_id', $siswas->kelas_id)== $item->kelas_id)
            <option value="{{$item->kelas_id}}" selected>{{$item->nama_kelas}}</option>
          @else
            <option value="{{$item->kelas_id}}">{{$item->nama_kelas}}</option>
          @endif
        @endforeach
      </select>
      @error('kelas_id')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="nama_siswa" class="form-label">Nama</label>
      <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" name="nama_siswa" value="{{ old('nama_siswa', $siswas->nama_siswa)}}">
      @error('nama_siswa')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
      <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" value="{{ old('tgl_lahir', $siswas->tgl_lahir)}}">
      @error('tgl_lahir')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
      <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
          <option value="" disabled selected>Pilih jenis kelamin</option>
          <option value="Laki-laki" {{ old('jenis_kelamin', $siswas->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
          <option value="Perempuan" {{ old('jenis_kelamin', $siswas->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
      </select>
      @error('jenis_kelamin')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
  </div>
  
    <div class="mb-3">
      <label for="alamat" class="form-label">Alamat</label>
      <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="4">{{ old('alamat', $siswas->alamat) }}</textarea>
      @error('alamat')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="nama_ortu" class="form-label">Nama Orang Tua</label>
      <input type="text" class="form-control @error('nama_ortu') is-invalid @enderror" name="nama_ortu" value="{{ old('nama_ortu', $siswas->nama_ortu)}}">
      @error('nama_ortu')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="telp" class="form-label">Nomor Telepon</label>
      <input type="tel" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" value="{{ old('telp', $siswas->telp) }}">
      @error('telp')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="foto_siswa" class="form-label">Foto 3x4 <span class="text-muted">(Tidak diisi jika tidak diubah)</span></label>
      <input type="file" class="form-control @error('foto_siswa') is-invalid @enderror" id="foto_siswa" name="foto_siswa" value="{{ old('foto_siswa', $siswas->foto_siswa) }}" accept="image/*">
      @error('foto_siswa')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
    </div>

      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection
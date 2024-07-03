@extends('layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Kelas</h1>
</div>
<div class="container text-center">
    @php
        $chunks = $kelas->chunk(4);
    @endphp
    @foreach ($chunks as $chunk)
        <div class="row mt-3">
            @foreach ($chunk as $kelasItem)
                <div class="col">
                    <a href="{{ route('jadwalpelajaran.show', $kelasItem->kelas_id) }}" class="btn btn-primary w-100">{{ $kelasItem->nama_kelas }}</a>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection
  {{-- <div class="container text-center">
    <div class="row">
        @php
            $halfCount = ceil(count($kelas) / 2); // Menghitung setengah dari total kelas
        @endphp

        <div class="col">
            @foreach($kelas->take($halfCount) as $item)
                <button class="w-100 mt-3 btn btn-primary" type="button">{{ $item->nama_kelas }}</button>
            @endforeach
        </div>

        <div class="col">
            @foreach($kelas->skip($halfCount) as $item)
                <button class="w-100 mt-3 btn btn-primary" type="button">{{ $item->nama_kelas }}</button>
            @endforeach
        </div>
    </div> --}}
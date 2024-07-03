@extends('layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Pengumuman</h1>
</div>
@if (session()->has('pesan'))
    <div class="alert alert-success mt-3" role="alert">
        {{session('pesan')}}
    </div>
@endif
<a href="/pengumuman/create" class="btn btn-primary"> <span data-feather="plus-circle"></span>
    Create Pengumuman </a>
    <table class="table table-bordered table-sm my-4">
        <tr>
            <th class="text-center align-middle">No</th>
            <th class="text-center align-middle">Judul</th>
            <th class="text-center align-middle">Deskripsi</th>
            <th class="text-center align-middle">Penerima</th>
            {{-- <th>Status</th> --}}
            <th class="text-center align-middle">Tgl Awal</th>
            <th class="text-center align-middle">Tgl Akhir</th>
            <th class="text-center align-middle">Pembuat</th>
            <th class="text-center align-middle">Aksi</th>
        </tr>
        @foreach ($pengumumans as $item)
        <tr>
            <td class="text-center align-middle">{{ $loop->iteration }}</td>
            <td class="text-center align-middle">{{ $item->judul }}</td>
            <td class="text-center align-middle">{{ $item->deskripsi }}</td>
            <td class="text-center align-middle">@if($item->penerima == 1)
                Siswa
            @elseif($item->penerima == 2)
                Guru
            @elseif($item->penerima == 3)
                Semua
                @endif
            </td>
            {{-- <td>{{ $item->status }}</td> --}}
            <td class="text-center align-middle">{{ $item->tgl_awal }}</td>
            <td class="text-center align-middle">{{ $item->tgl_akhir }}</td>
            <td class="text-center align-middle">{{ $item->adminSistem->nama_pegawai }}</td>
            </td>
            <td class="text-center align-middle">
                <a href="pengumuman/{{ $item->pengumuman_id }}/edit" class="btn btn-warning btn-sm"><span data-feather="edit"></span>Edit</a>
                <form action="pengumuman/{{$item->pengumuman_id}}" method="post" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data ?')"><span data-feather="trash-2"></span>Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{$pengumumans->links()}}
@endsection
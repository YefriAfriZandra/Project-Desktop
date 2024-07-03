@extends('layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Jenis Komite</h1>
</div>
@if (session()->has('pesan'))
    <div class="alert alert-success mt-3" role="alert">
        {{session('pesan')}}
    </div>
    @endif
    <a href="/jenisKomite/create" class="btn btn-primary"> <span data-feather="plus-circle"></span>
        Create Jenis Komite </a>
    {{-- <div class="card mt-2 p-3"> --}}
        <table class="table table-bordered table-sm my-4">
        <tr>
            <th class="text-center align-middle">No</th>
            <th class="text-center align-middle">Tipe</th>
            <th class="text-center align-middle">Deskripsi</th>
            <th class="text-center align-middle">Biaya</th>
            <th class="text-center align-middle">Aksi</th>
        </tr>
        @foreach ($jenis_komites as $item)
        <tr>
            <td class="text-center align-middle">{{ $loop->iteration }}</td>
            <td class="text-center align-middle">
                @if ($item->type == 1)
                    Pegawai Negeri
                @elseif ($item->type == 2)
                    Pegawai Swasta
                @elseif ($item->type == 3)
                    Wiraswasta
                @elseif ($item->type == 4)
                    Pensiunan
                @elseif ($item->type == 5)
                    Pelajar/Mahasiswa
                @elseif ($item->type == 6)
                    Pekerja Lepas
                @elseif ($item->type == 7)
                    Ibu Rumah Tangga
                @elseif ($item->type == 8)
                    Tidak Bekerja
                @elseif ($item->type == 9)
                    Lainnya
                @else
                    Tidak Diketahui
                @endif
            </td>
            <td class="text-center align-middle">{{ $item->deskripsi }}</td>
            <td class="text-center align-middle">{{ $item->biaya }}</td>
        </td>
        <td class="text-center align-middle">
            <a href="jenisKomite/{{ $item->jenis_komite_id }}/edit" class="btn btn-warning btn-sm"><span data-feather="edit"></span>Edit</a>
            <form action="jenisKomite/{{$item->jenis_komite_id}}" method="post" class="d-inline">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data ?')"><span data-feather="trash-2"></span>Delete</button>
            </form>
        </td>
    </tr>
        @endforeach
    </table>
    {{-- </div> --}}
    {{$jenis_komites->links()}}
    @endsection
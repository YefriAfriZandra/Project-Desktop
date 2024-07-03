@extends('layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pembayaran Komite</h1>
</div>
@if (session()->has('pesan'))
    <div class="alert alert-success mt-3" role="alert">
        {{session('pesan')}}
    </div>
@endif
<a href="/pembayaranKomite/create" class="btn btn-primary"> <span data-feather="plus-circle"></span>
    Create Pelajaran </a>
    <table class="table table-bordered table-sm my-4">
        <tr>
            <th class="text-center align-middle">No</th>
            <th class="text-center align-middle">Nama Siswa</th>
            <th class="text-center align-middle">Tipe Komite</th>
            <th class="text-center align-middle">Pegawai</th>
            <th class="text-center align-middle">Bulan</th>
            <th class="text-center align-middle">Jumlah</th>
            <th class="text-center align-middle">Tgl bayar</th>
            <th class="text-center align-middle">Status</th>
            <th class="text-center align-middle">Aksi</th>
        </tr>
        @foreach ($pembayarankomite as $item)
        <tr>
            <td class="text-center align-middle">{{ $loop->iteration }}</td>
            <td class="text-center align-middle">{{ $item->siswa->nama_siswa }}</td>
            {{-- <td class="text-center align-middle">{{ $item->jenis_komite->type }}</td> --}}
            <td class="text-center align-middle">
                @if ($item->jenis_komite->type == 1)
                    Pegawai Negeri
                @elseif ($item->jenis_komite->type == 2)
                    Pegawai Swasta
                @elseif ($item->jenis_komite->type == 3)
                    Wiraswasta
                @elseif ($item->jenis_komite->type == 4)
                    Pensiunan
                @elseif ($item->jenis_komite->type == 5)
                    Pelajar/Mahasiswa
                @elseif ($item->jenis_komite->type == 6)
                    Pekerja Lepas
                @elseif ($item->jenis_komite->type == 7)
                    Ibu Rumah Tangga
                @elseif ($item->jenis_komite->type == 8)
                    Tidak Bekerja
                @elseif ($item->jenis_komite->type == 9)
                    Lainnya
                @else
                    Tidak Diketahui
                @endif
            </td>
            <td class="text-center align-middle">{{ $item->pegawaipembayaran->nama_pegawai }}</td>
            <td class="text-center align-middle">{{ $item->bulan }}</td>
            <td class="text-center align-middle">{{ $item->jml_bayar }}</td>
            <td class="text-center align-middle">{{ $item->tgl_bayar }}</td>
            <td class="text-center align-middle">{{ $item->status }}</td>
            </td>
            <td class="text-center align-middle">
                <a href="pembayaranKomite/{{$item->pembayaran_id}}/edit" class="btn btn-warning btn-sm"><span data-feather="edit"></span>Edit</a>
                <form action="pembayaranKomite/{{$item->pembayaran_id}}" method="post" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data ?')"><span data-feather="trash-2"></span>Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{$pembayarankomite->links()}}
@endsection
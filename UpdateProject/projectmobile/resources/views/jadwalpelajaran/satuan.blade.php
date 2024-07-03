@extends('layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Jadwal Pelajaran Kelas {{--nama_kelas (button yang di klik )--}}</h1> 
</div>
@if (session()->has('pesan'))
    <div class="alert alert-success mt-3" role="alert">
        {{session('pesan')}}
    </div>
@endif
{{-- <a href="/jadwalpelajaran/create" class="btn btn-primary"> <span data-feather="plus-circle"></span>
    Create Jadwal Kelas</a> --}}
    <table class="table table-bordered table-sm my-4">
        <tr>
            <th class="text-center align-middle">No</th>
            <th class="text-center align-middle">Hari</th>
            <th class="text-center align-middle">Jam</th>
            <th class="text-center align-middle">Nama Pelajaran</th>
            <th class="text-center align-middle">Nama Guru</th>
        </tr>
        @foreach ($jadwalPelajaran as $item)
        <tr>
            <td class="text-center align-middle">{{ $loop->iteration }}</td>
            <td class="text-center align-middle">{{ $item->hari }}</td>
            <td class="text-center align-middle">{{ $item->jam }}</td>
            <td class="text-center align-middle">{{ $item->pelajaran->nama_pelajaran }}</td>
            <td class="text-center align-middle">{{ $item->guru->nama_guru }}</td>
            </td>
            <td class="text-center align-middle">
                <a href="/jadwalpelajaran/{{ $item->jadwal_pelajaran_id }}/edit" class="btn btn-warning btn-sm"><span data-feather="edit"></span>Edit</a>
                <form action="/jadwalpelajaran/{{ $item->jadwal_pelajaran_id }}" method="post" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data ?')"><span data-feather="trash-2"></span>Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{$jadwalPelajaran->links()}}
@endsection
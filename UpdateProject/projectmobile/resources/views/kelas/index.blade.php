@extends('layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Kelas</h1>
</div>
@if (session()->has('pesan'))
    <div class="alert alert-success mt-3" role="alert">
        {{session('pesan')}}
    </div>
@endif
<a href="/routeKelas/create" class="btn btn-primary"> <span data-feather="plus-circle"></span>
    Create Kelas </a>
    <table class="table table-bordered table-sm my-4">
        <tr>
            <th class="text-center align-middle">No</th>
            <th class="text-center align-middle">Kelas</th>
            <th class="text-center align-middle">Jumlah Siswa</th>
            <th class="text-center align-middle">Aksi</th>
        </tr>
        @foreach ($kelass as $item)
        <tr>
            <td class="text-center align-middle">{{ $loop->iteration }}</td>
            <td class="text-center align-middle">{{ $item->nama_kelas }}</td>
            <td class="text-center align-middle">{{ $item->jumlah_siswa }}</td>
            </td>
            <td class="text-center align-middle">
                <a href="routeKelas/{{ $item->kelas_id }}/edit" class="btn btn-warning btn-sm"><span data-feather="edit"></span>Edit</a>
                <form action="routeKelas/{{$item->kelas_id}}" method="post" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data ?')"><span data-feather="trash-2"></span>Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{$kelass->links()}}
@endsection
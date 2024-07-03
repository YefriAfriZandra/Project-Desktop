@extends('layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Guru</h1>
</div>
@if (session()->has('pesan'))
    <div class="alert alert-success mt-3" role="alert">
        {{session('pesan')}}
    </div>
@endif

<div class="mb-3">
    <form action="{{ url('/usersGuru/search') }}" method="GET" class="d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Search by NIS or Name" required>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<a href="/usersGuru/create" class="btn btn-primary"> <span data-feather="plus-circle"></span>
    Create User </a>
    <table class="table table-bordered table-sm my-4">
        <tr>
            <th class="text-center align-middle">No</th>
            <th class="text-center align-middle">Foto</th>
            <th class="text-center align-middle">NIP</th>
            <th class="text-center align-middle">Nama</th>
            <th class="text-center align-middle">Jenis Kelamin</th>
            <th class="text-center align-middle">Alamat</th>
            <th class="text-center align-middle">No.Telp</th>
            <th class="text-center align-middle">Edit</th>
        </tr>
        @foreach ($gurus as $item)
        <tr>
            <td class="text-center align-middle">{{ $loop->iteration }}</td>
            <td class="text-center align-middle"><img src="/images/{{ $item->foto_guru }}" alt="" style="width: 95px; height: 120px"></td>
            <td class="text-center align-middle">{{ $item->nip_guru }}</td>
            <td class="text-center align-middle">{{ $item->nama_guru }}</td>
            <td class="text-center align-middle">{{ $item->jenis_kelamin }}</td>
            <td class="text-center align-middle">{{ $item->alamat }}</td>
            <td class="text-center align-middle">{{ $item->telp }}</td>          
            </td>
            <td class="text-center align-middle">
                <a href="usersGuru/{{ $item->nip_guru }}/edit" class="btn btn-warning btn-sm"><span data-feather="edit"></span></a>
                <form action="usersGuru/{{$item->nip_guru}}" method="post" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data ?')"><span data-feather="trash-2"></span></button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{$gurus->links()}}
@endsection
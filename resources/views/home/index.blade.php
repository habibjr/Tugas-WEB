@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <h1 class="text-center" style="margin: 10px">Website Pendaftaran Haji</h1>
        <div class="col">
            <div class="card" style="margin: 20px">
                <div class="card-header">
                    <h5>Daftar Peserta Haji
                        <a href="{{ route('home.create') }}" class="btn btn-primary float-end">Tambah Data</a>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Foto 3x4</th>
                                <th scope="col">NIK</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('image/' . $d->foto) }}" alt="Foto" width="70"
                                            height="70">
                                    </td>
                                    <td>{{ $d->nik }}</td>
                                    <td>{{ $d->nama }}</td>
                                    <td>{{ $d->alamat }}</td>
                                    <td>{{ $d->jenis_kelamin }}</td>
                                    <td>
                                        <a href="{{ route('home.edit', $d->id) }}" class="btn btn-warning">Edit</a>
                                        <a href="{{ route('home.destroy', $d->id) }}" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('logout') }}" class="btn btn-danger">logout</a>
            </div>
        </div>
    </div>
@endsection

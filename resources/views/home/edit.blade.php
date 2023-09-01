@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="col" style="margin: 20px">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('home.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="number" name="nik" value="{{ $data->nik }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" value="{{ $data->nama }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" value="{{ $data->alamat }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <input type="text" name="jenis_kelamin" value="{{ $data->jenis_kelamin }}"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto 3x4</label>
                            <input type="file" name="foto" id="foto" class="form-control">
                        </div>
                        <div class="card" style="margin-top: 10px">
                            <div class="card-body">
                                <img src="{{ asset('image/' . $data->foto) }}" width="100" alt="">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

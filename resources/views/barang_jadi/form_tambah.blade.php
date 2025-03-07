@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-4 mx-auto col-6 bg-white">

        <div class="mb-4">
            <h2 class="fw-bold">Tambah Data Barang Jadi</h2>
        </div>

        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('barang-jadi.tambah') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="kode_bahan">Kode Barang</label>
                <input type="text" name="id" id="kode_bahan" class="form-control" value="{{ old('id') }}" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>

            <div class="form-group">
                <label for="pureng_plendes">Pureng Plendes</label>
                <select name="pureng_plendes" id="pureng_plendes" class="form-control" required>
                    <option value="pureng">Pureng</option>
                    <option value="plendes">Plendes</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success mt-3 mr-2">Simpan</button>
            <a href="{{route('barang-jadi.show')}}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
</div>

@endsection
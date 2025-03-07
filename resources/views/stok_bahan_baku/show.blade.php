<!-- resources/views/stok-bahan-baku/index.blade.php -->
@extends('layouts.app')

@section('title', 'Stok Bahan Baku')

@section('content')

<div class="container">
    <p class="mb-3 text-right">
        {{\Carbon\Carbon::now()->translatedFormat('F Y') }}
    </p>
    <div class="row">
        <div class="col-6">
            <h2 class="mb-0 fw-bold">Stok Bahan Baku</h2>

        </div>
        <div class="col-6 d-flex justify-content-end align-items-end">
            <a href="{{route('pemesanan-bahan-baku.form-tambah')}}" class="btn btn-primary">Tambah Stok</a>
        </div>
    </div>
    <table class="table table-bordered mt-3 bg-white">
        <thead class="thead-light">
            <tr>
                <th>Kode Bahan</th>
                <th>Nama Bahan</th>
                <th>Jenis Bahan</th>
                <th>Stok Awal</th>
                <th>Bahan Masuk</th>
                <th>Bahan Keluar</th>
                <!-- <th>Minimal</th> -->
                <th>Stok Akhir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stokBahanBaku as $item)
            <tr>
                <td>{{ $item->bahan_baku->id }}</td>
                <td>{{ $item->bahan_baku->nama }}</td>
                <td>{{ $item->bahan_baku->jenis }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->jumlah_masuk }}</td>
                <td>{{ $item->jumlah_keluar }}</td>
                <!-- <td>{{ $item->bahan_baku->minimal }}</td> -->
                <td>{{ $item->jumlah }}</td>
                <td><a href="{{route('bahan-baku-keluar.form-tambah', $item->bahan_baku->id)}}" class="btn btn-info btn-sm mr-2">Ambil</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
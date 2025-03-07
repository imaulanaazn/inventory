@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-6">
            <h2 class="mb-0 fw-bold">Riwayat Barang Setengah Jadi Masuk</h2>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-end">
            <a href="{{route('barang-setengah-jadi-masuk.form-tambah')}}" class="btn btn-primary">Tambah Stok</a>
        </div>
    </div>

    <table class="table table-bordered mt-3 bg-white">
        <thead class="thead-light">
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Tanggal Masuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangMasuk as $barang)
            <tr>
                <td>{{ $barang->brg_setengah_jadi->id }}</td>
                <td>{{ $barang->brg_setengah_jadi->nama }}</td>
                <td>{{ $barang->brg_setengah_jadi->jenis }}</td>
                <td>{{ $barang->jumlah }}</td>
                <td>{{ $barang->keterangan }}</td>
                <td>{{ \Carbon\Carbon::parse($barang->created_at)->translatedFormat('d F Y') }}</td>
                <td>
                    <a href="{{route('barang-setengah-jadi-masuk.form-ubah', $barang->id)}}" class="btn btn-warning btn-sm mr-2">Edit</a>
                    <form action="{{route('barang-setengah-jadi-masuk.hapus', $barang->id)}}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
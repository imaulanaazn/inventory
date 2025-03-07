<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BarangJadi;
use App\Models\BarangJadiKeluar;
use App\Models\StokBarangJadi;
use Illuminate\Http\Request;

class BarangJadiKeluarController extends Controller
{
    public function show()
    {
        $barangKeluar = BarangJadiKeluar::with('barang_jadi')->get();
        return view('barang_jadi_keluar.show', compact('barangKeluar'));
    }

    public function formTambah($kode_barang)
    {
        $barangJadi = BarangJadi::where('id', $kode_barang)->first();
        $stokBarangJadi = StokBarangJadi::where('brg_jadi_id', $kode_barang)->first();
        return view('barang_jadi_keluar.form_tambah', compact('barangJadi', 'stokBarangJadi'));
    }

    public function tambahBarangKeluar(Request $request)
    {
        $barangKeluar = new BarangJadiKeluar();
        $barangKeluar->brg_jadi_id = $request->kode_barang;
        $barangKeluar->jumlah = $request->jumlah;
        $barangKeluar->keterangan = $request->keterangan;
        $barangKeluar->created_at = $request->created_at;
        $barangKeluar->updated_at = $request->created_at;

        $barangKeluar->save();

        $stokBarangJadi = StokBarangJadi::where('brg_jadi_id', $request->kode_barang)->first();
        $stokBarangJadi->jumlah -= $request->jumlah;
        $stokBarangJadi->jumlah_keluar += $request->jumlah;
        $stokBarangJadi->save();

        return redirect()->route('barang-jadi-keluar.show')->with('success', 'Barang jadi keluar berhasil diubah');
    }


    public function formUbah($idKeluar)
    {
        $barangKeluar = BarangJadiKeluar::find($idKeluar);
        $stokBarangJadi = StokBarangJadi::where('brg_jadi_id', $barangKeluar->brg_jadi_id)->first();
        return view('barang_jadi_keluar.form_ubah', compact('barangKeluar', 'stokBarangJadi'));
    }

    public function ubahBarangKeluar(Request $request, $idKeluar)
    {
        $dataKeluar = BarangJadiKeluar::find($idKeluar);
        $diff = $request->jumlah - $dataKeluar->jumlah;

        $dataKeluar->brg_jadi_id = $request->kode_barang;
        $dataKeluar->jumlah = $request->jumlah;
        $dataKeluar->keterangan = $request->keterangan;
        $dataKeluar->created_at = $request->created_at;
        $dataKeluar->updated_at = $request->created_at;

        $dataKeluar->save();

        $stokBarangJadi = StokBarangJadi::where('brg_jadi_id', $request->kode_barang)->first();
        $stokBarangJadi->jumlah -= $diff;
        $stokBarangJadi->jumlah_keluar += $diff;
        $stokBarangJadi->save();

        return redirect()->route('barang-jadi-keluar.show')->with('success', 'Barang jadi keluar berhasil diubah');
    }

    public function hapusBarangKeluar($idKeluar)
    {
        $dataKeluar = BarangJadiKeluar::find($idKeluar);
        $stokBarangJadi = StokBarangJadi::where('brg_jadi_id', $dataKeluar->brg_jadi_id)->first();

        $stokBarangJadi->jumlah += $dataKeluar->jumlah;
        $stokBarangJadi->jumlah_keluar -= $dataKeluar->jumlah;
        $stokBarangJadi->save();

        $dataKeluar->delete();

        return redirect()->route('barang-jadi-keluar.show')->with('success', 'Barang jadi keluar berhasil dihapus');
    }
}

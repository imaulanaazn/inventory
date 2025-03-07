<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BarangSetengahJadi;
use App\Models\BarangSetengahJadiKeluar;
use App\Models\StokBarangSetengahJadi;
use Illuminate\Http\Request;

class BarangSetengahJadiKeluarController extends Controller
{
    public function show()
    {
        $barangKeluar = BarangSetengahJadiKeluar::with('brg_setengah_jadi')->get();
        return view('barang_setengah_jadi_keluar.show', compact('barangKeluar'));
    }

    public function formTambah($kode_barang)
    {
        $barangSetengahJadi = BarangSetengahJadi::where('id', $kode_barang)->first();
        $stokBarangSetengahJadi = StokBarangSetengahJadi::where('brg_setengah_jadi_id', $kode_barang)->first();
        return view('barang_setengah_jadi_keluar.form_tambah', compact('barangSetengahJadi', 'stokBarangSetengahJadi'));
    }

    public function tambahBarangKeluar(Request $request)
    {
        $barangKeluar = new BarangSetengahJadiKeluar();
        $barangKeluar->brg_setengah_jadi_id = $request->kode_barang;
        $barangKeluar->jumlah = $request->jumlah;
        $barangKeluar->keterangan = $request->keterangan;
        $barangKeluar->created_at = $request->created_at;
        $barangKeluar->updated_at = $request->created_at;

        $barangKeluar->save();

        $stokBarangSetengahJadi = StokBarangSetengahJadi::where('brg_setengah_jadi_id', $request->kode_barang)->first();
        $stokBarangSetengahJadi->jumlah -= $request->jumlah;
        $stokBarangSetengahJadi->jumlah_keluar += $request->jumlah;
        $stokBarangSetengahJadi->save();

        return redirect()->route('barang-setengah-jadi-keluar.show')->with('success', 'Barang setengah jadi keluar berhasil diubah');
    }


    public function formUbah($idKeluar)
    {
        $barangKeluar = BarangSetengahJadiKeluar::find($idKeluar);
        $stokBarangSetengahJadi = StokBarangSetengahJadi::where('brg_setengah_jadi_id', $barangKeluar->brg_setengah_jadi_id)->first();
        return view('barang_setengah_jadi_keluar.form_ubah', compact('barangKeluar', 'stokBarangSetengahJadi'));
    }

    public function ubahBarangKeluar(Request $request, $idKeluar)
    {
        $dataKeluar = BarangSetengahJadiKeluar::find($idKeluar);
        $diff = $request->jumlah - $dataKeluar->jumlah;

        $dataKeluar->brg_setengah_jadi_id = $request->kode_barang;
        $dataKeluar->jumlah = $request->jumlah;
        $dataKeluar->keterangan = $request->keterangan;
        $dataKeluar->created_at = $request->created_at;
        $dataKeluar->updated_at = $request->created_at;

        $dataKeluar->save();

        $stokBarangSetengahJadi = StokBarangSetengahJadi::where('brg_setengah_jadi_id', $request->kode_barang)->first();
        $stokBarangSetengahJadi->jumlah -= $diff;
        $stokBarangSetengahJadi->jumlah_keluar += $diff;
        $stokBarangSetengahJadi->save();

        return redirect()->route('barang-setengah-jadi-keluar.show')->with('success', 'Barang setengah jadi keluar berhasil diubah');
    }

    public function hapusBarangKeluar($idKeluar)
    {
        $dataKeluar = BarangSetengahJadiKeluar::find($idKeluar);
        $stokBarangSetengahJadi = StokBarangSetengahJadi::where('brg_setengah_jadi_id', $dataKeluar->brg_setengah_jadi_id)->first();

        $stokBarangSetengahJadi->jumlah += $dataKeluar->jumlah;
        $stokBarangSetengahJadi->jumlah_keluar -= $dataKeluar->jumlah;
        $stokBarangSetengahJadi->save();

        $dataKeluar->delete();

        return redirect()->route('barang-setengah-jadi-keluar.show')->with('success', 'Barang setengah jadi keluar berhasil dihapus');
    }
}

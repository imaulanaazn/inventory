<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BarangJadi;
use App\Models\BarangJadiMasuk;
use App\Models\StokBarangJadi;
use Illuminate\Http\Request;

class BarangJadiMasukController extends Controller
{
    public function show()
    {
        $barangMasuk = BarangJadiMasuk::with('barang_jadi')->get();
        return view('barang_jadi_masuk.show', compact('barangMasuk'));
    }

    public function formTambah($kode_barang = null)
    {
        $barangJadi = $kode_barang
            ? BarangJadi::where('id', $kode_barang)->get()
            : BarangJadi::all();
        return view('barang_jadi_masuk.form_tambah', compact('barangJadi'));
    }

    public function tambahBarangMasuk(Request $request)
    {
        $barangMasuk = new BarangJadiMasuk();
        $barangMasuk->brg_jadi_id = $request->kode_barang;
        $barangMasuk->jumlah = $request->jumlah;
        $barangMasuk->keterangan = $request->keterangan;
        $barangMasuk->created_at = $request->created_at;
        $barangMasuk->updated_at = $request->created_at;

        $barangMasuk->save();

        $stokBarangJadi = StokBarangJadi::where('brg_jadi_id', $request->kode_barang)->first();
        $stokBarangJadi->jumlah += $request->jumlah;
        $stokBarangJadi->jumlah_masuk += $request->jumlah;

        $stokBarangJadi->save();

        return redirect()->route('barang-jadi-masuk.show')->with('success', 'Barang jadi masuk berhasil ditambahkan');
    }

    public function formUbah($id)
    {
        $barangMasuk = BarangJadiMasuk::where('id', $id)->first();
        return view('barang_jadi_masuk.form_ubah', compact('barangMasuk'));
    }

    public function ubahBarangMasuk(Request $request, $id)
    {
        $barangMasuk = BarangJadiMasuk::find($id);

        $diff = $request->jumlah - $barangMasuk->jumlah;

        $barangMasuk->jumlah = $request->jumlah;
        $barangMasuk->keterangan = $request->keterangan;
        $barangMasuk->created_at = $request->created_at;
        $barangMasuk->updated_at = $request->created_at;

        $barangMasuk->save();

        $stokBarangJadi = StokBarangJadi::where('brg_jadi_id', $request->kode_barang)->first();
        $stokBarangJadi->jumlah += $diff;
        $stokBarangJadi->jumlah_masuk += $diff;
        $stokBarangJadi->save();

        return redirect()->route('barang-jadi-masuk.show')->with('success', 'Barang jadi masuk berhasil diubah');
    }

    public function hapusBarangMasuk($id)
    {
        $barangMasuk = BarangJadiMasuk::find($id);
        $barangMasuk->delete();

        $stokBarangJadi = StokBarangJadi::where('brg_jadi_id', $barangMasuk->brg_jadi_id)->first();
        $stokBarangJadi->jumlah -= $barangMasuk->jumlah;
        $stokBarangJadi->jumlah_masuk -= $barangMasuk->jumlah;
        $stokBarangJadi->save();

        return redirect()->route('barang-jadi-masuk.show')->with('success', 'Barang jadi masuk berhasil dihapus');
    }
}

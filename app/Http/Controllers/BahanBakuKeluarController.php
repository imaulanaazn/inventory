<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use App\Models\BahanBakuKeluar;
use App\Models\StokBahanBaku;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Date;

class BahanBakuKeluarController extends Controller
{
    public function show()
    {
        $bahanBakuKeluar = BahanBakuKeluar::with('bahan_baku')->get();
        return view('bahan_baku_keluar.show', compact('bahanBakuKeluar'));
    }

    public function formTambah($kode_bahan)
    {
        $bahanBaku = BahanBaku::where('id', $kode_bahan)->first();
        $stokBahanBaku = StokBahanBaku::where('bahan_baku_id', $kode_bahan)->first();
        return view('bahan_baku_keluar.form_tambah', compact('bahanBaku', 'stokBahanBaku'));
    }

    public function tambahBahanKeluar(Request $request)
    {
        $keluar = new BahanBakuKeluar();
        $keluar->bahan_baku_id = $request->kode_bahan;
        $keluar->jumlah = $request->jumlah;
        $keluar->keterangan = $request->keterangan;
        $keluar->created_at = $request->created_at;
        $keluar->updated_at = $request->created_at;

        $keluar->save();

        $stokBahanBaku = StokBahanBaku::where('bahan_baku_id', $request->kode_bahan)->first();
        $stokBahanBaku->jumlah -= $request->jumlah;
        $stokBahanBaku->jumlah_keluar += $request->jumlah;
        $stokBahanBaku->save();

        return redirect()->route('bahan-baku-keluar.show')->with('success', 'Bahan baku keluar berhasil ditambahkan');
    }


    public function formUbah($idKeluar)
    {
        $dataKeluar = BahanBakuKeluar::with('bahan_baku')->find($idKeluar);
        $stokBahanBaku = StokBahanBaku::where('bahan_baku_id', $dataKeluar->bahan_baku_id)->first();
        return view('bahan_baku_keluar.form_ubah', compact('dataKeluar', 'stokBahanBaku'));
    }

    public function ubahBahanKeluar(Request $request, $idKeluar)
    {
        $dataKeluar = BahanBakuKeluar::find($idKeluar);
        $diff = $request->jumlah - $dataKeluar->jumlah;

        $dataKeluar->bahan_baku_id = $request->kode_bahan;
        $dataKeluar->jumlah = $request->jumlah;
        $dataKeluar->keterangan = $request->keterangan;
        $dataKeluar->created_at = $request->created_at;
        $dataKeluar->updated_at = $request->created_at;

        $dataKeluar->save();

        $stokBahanBaku = StokBahanBaku::where('bahan_baku_id', $request->kode_bahan)->first();
        $stokBahanBaku->jumlah -= $diff;
        $stokBahanBaku->jumlah_keluar += $diff;
        $stokBahanBaku->save();

        return redirect()->route('bahan-baku-keluar.show')->with('success', 'Bahan baku keluar berhasil diubah');
    }

    public function hapusBahanKeluar($idKeluar)
    {
        $dataKeluar = BahanBakuKeluar::find($idKeluar);
        $stokBahanBaku = StokBahanBaku::where('bahan_baku_id', $dataKeluar->bahan_baku_id)->first();

        $stokBahanBaku->jumlah += $dataKeluar->jumlah;
        $stokBahanBaku->jumlah_keluar -= $dataKeluar->jumlah;
        $stokBahanBaku->save();

        $dataKeluar->delete();

        return redirect()->route('bahan-baku-keluar.show')->with('success', 'Bahan baku keluar berhasil dihapus');
    }
}

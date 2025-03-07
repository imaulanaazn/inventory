<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use App\Models\PemesananBahanBaku;
use App\Models\StokBahanBaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class PemesananBahanBakuController extends Controller
{

    public function show()
    {
        $pemesananBahanBaku = PemesananBahanBaku::with('bahan_baku')->get();
        return view('pemesanan_bahan_baku.show', compact('pemesananBahanBaku'));
    }

    public function formTambah($kode_bahan = null)
    {
        $bahan_baku = $kode_bahan
            ? BahanBaku::where('id', $kode_bahan)->get()
            : BahanBaku::all();
        return view('pemesanan_bahan_baku.form_tambah', compact('bahan_baku'));
    }

    public function formEdit($idPesanan)
    {
        $pemesanan = PemesananBahanBaku::find($idPesanan);
        return view('pemesanan_bahan_baku.form_edit', compact('pemesanan'));
    }

    public function updatePemesanan(Request $request, $idPesanan)
    {

        $pesanan = PemesananBahanBaku::find($idPesanan);

        $diff = $request->jumlah - $pesanan->jumlah;

        $pesanan->jumlah = $request->jumlah;
        $pesanan->keterangan = $request->keterangan;
        $pesanan->updated_at = $request->created_at;
        $pesanan->created_at = $request->created_at;

        $pesanan->save();

        $stokBahanBaku = StokBahanBaku::where('bahan_baku_id', $request->kode_bahan)->first();
        $stokBahanBaku->jumlah += $diff;
        $stokBahanBaku->jumlah_masuk += $diff;
        $stokBahanBaku->save();

        return redirect()->route('pemesanan-bahan-baku.show')->with('success', 'Pemesanan berhasil diubah');
    }

    public function hapusPemesanan($idPesanan)
    {
        $pesanan = PemesananBahanBaku::find($idPesanan);
        $stokBahanBaku = StokBahanBaku::where('bahan_baku_id', $pesanan->bahan_baku_id)->first();
        $stokBahanBaku->jumlah -= $pesanan->jumlah;
        $stokBahanBaku->jumlah_masuk -= $pesanan->jumlah;
        $stokBahanBaku->save();
        $pesanan->delete();

        return redirect()->route('pemesanan-bahan-baku.show')->with('success', 'Pemesanan berhasil dihapus');
    }

    public function create(Request $request)
    {
        $pesanan = new PemesananBahanBaku();
        $pesanan->bahan_baku_id = $request->kode_bahan;
        $pesanan->jumlah = $request->jumlah;
        $pesanan->keterangan = $request->keterangan;
        $pesanan->created_at = $request->created_at;
        $pesanan->updated_at = $request->created_at;

        $pesanan->save();

        $stokBahanBaku = StokBahanBaku::where('bahan_baku_id', $request->kode_bahan)->first();
        $stokBahanBaku->jumlah += $request->jumlah;
        $stokBahanBaku->jumlah_masuk += $request->jumlah;
        $stokBahanBaku->save();

        return redirect()->route('pemesanan-bahan-baku.show')->with('success', 'Pemesanan berhasil');
    }
}

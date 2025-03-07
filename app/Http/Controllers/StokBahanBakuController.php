<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use App\Models\StokBahanBaku;
use Illuminate\Http\Request;

class StokBahanBakuController extends Controller
{
    public function show()
    {
        $stokBahanBaku = StokBahanBaku::with('bahan_baku')->get();
        return view('stok_bahan_baku.show', compact('stokBahanBaku'));
    }

    public function create(Request $request)
    {
        $stokBahanBaku = new StokBahanBaku;

        $stokBahanBaku->bahan_baku_id = $request->bahan_baku_id;
        $stokBahanBaku->jumlah = $request->jumlah;
        $stokBahanBaku->jumlah_masuk = $request->jumlah_masuk;
        $stokBahanBaku->jumlah_keluar = $request->jumlah_keluar;

        $stokBahanBaku->save();

        return response()->json($stokBahanBaku);
    }

    public function update(Request $request, $id)
    {
        $stokBahanBaku = StokBahanBaku::find($id);

        $stokBahanBaku->bahan_baku_id = $request->bahan_baku_id;
        $stokBahanBaku->jumlah = $request->jumlah;
        $stokBahanBaku->jumlah_masuk = $request->jumlah_masuk;
        $stokBahanBaku->jumlah_keluar = $request->jumlah_keluar;

        $stokBahanBaku->save();

        return response()->json($stokBahanBaku);
    }

    public function destroy($id)
    {
        $stokBahanBaku = StokBahanBaku::find($id);
        $stokBahanBaku->delete();

        return response()->json('deleted');
    }
}

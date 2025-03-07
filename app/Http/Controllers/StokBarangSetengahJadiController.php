<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StokBarangSetengahJadi;
use Illuminate\Http\Request;

class StokBarangSetengahJadiController extends Controller
{
    public function show()
    {
        $stokBarangSetengahJadi = StokBarangSetengahJadi::with('brg_setengah_jadi')->get();
        return view('stok_barang_setengah_jadi.show', compact('stokBarangSetengahJadi'));
    }
}

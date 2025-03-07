<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StokBarangJadi;
use Illuminate\Http\Request;

class StokBarangJadiController extends Controller
{
    public function show()
    {
        $stokBarangJadi = StokBarangJadi::with('barang_jadi')->get();
        return view('stok_barang_jadi.show', compact('stokBarangJadi'));
    }
}

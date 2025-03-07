<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\BahanBakuKeluarController;
use App\Http\Controllers\BarangJadiController;
use App\Http\Controllers\BarangJadiKeluarController;
use App\Http\Controllers\BarangJadiMasukController;
use App\Http\Controllers\BarangSetengahJadiController;
use App\Http\Controllers\BarangSetengahJadiKeluarController;
use App\Http\Controllers\BarangSetengahJadiMasukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemesananBahanBakuController;
use App\Http\Controllers\PemesananBarangJadiController;
use App\Http\Controllers\PotonganController;
use App\Http\Controllers\StokBahanBakuController;
use App\Http\Controllers\StokBarangJadiController;
use App\Http\Controllers\StokBarangSetengahJadiController;
use App\Models\BarangJadiKeluar;
use App\Models\BarangJadiMasuk;
use App\Models\PemesananBarangJadi;
use App\Models\StokBarangJadi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;
        return $role === 'manager' ? redirect('/manager') : redirect('/dashboard');
    }

    return redirect('/login');
});

// Route untuk login
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
});

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::middleware(['auth', 'role:admin'])->group(function () {

    // BAHAN BAKU STOK
    Route::get('stok-bahan-baku', [StokBahanBakuController::class, 'show'])->name('stok-bahan-baku.show');
    // Route::post('stok-bahan-baku', [StokBahanBakuController::class, 'create'])->name('stok-bahan-baku.create');
    // Route::get('stok-bahan-baku/{id}', [StokBahanBakuController::class, 'show'])->name('stok-bahan-baku.show');
    // Route::put('stok-bahan-baku/{id}', [StokBahanBakuController::class, 'update'])->name('stok-bahan-baku.update');
    // Route::delete('stok-bahan-baku/{id}', [StokBahanBakuController::class, 'destroy'])->name('stok-bahan-baku.destroy');

    //BAHAN BAKU MASUK
    Route::get('pemesanan-bahan-baku', [PemesananBahanBakuController::class, 'show'])->name('pemesanan-bahan-baku.show');
    Route::post('pemesanan-bahan-baku', [PemesananBahanBakuController::class, 'create'])->name('pemesanan-bahan-baku.create');
    Route::get('pemesanan-bahan-baku/tambah/{kode_bahan?}', [PemesananBahanBakuController::class, 'formTambah'])->name('pemesanan-bahan-baku.form-tambah');
    Route::get('pemesanan-bahan-baku/edit/{id_pesanan}', [PemesananBahanBakuController::class, 'formEdit'])->name('pemesanan-bahan-baku.form-edit');
    Route::put('pemesanan-bahan-baku/edit/{id_pesanan}', [PemesananBahanBakuController::class, 'updatePemesanan'])->name('pemesanan-bahan-baku.update');
    Route::delete('pemesanan-bahan-baku/delete/{id_pesanan}', [PemesananBahanBakuController::class, 'hapusPemesanan'])->name('pemesanan-bahan-baku.delete');

    //BAHAN BAKU KELUAR
    Route::get('bahan-baku-keluar', [BahanBakuKeluarController::class, 'show'])->name('bahan-baku-keluar.show');
    Route::get('bahan-baku-keluar/tambah/{kode_bahan}', [BahanBakuKeluarController::class, 'formTambah'])->name('bahan-baku-keluar.form-tambah');
    Route::post('bahan-baku-keluar/tambah/{kode_bahan}', [BahanBakuKeluarController::class, 'tambahBahanKeluar'])->name('bahan-baku-keluar.tambah');
    Route::get('bahan-baku-keluar/ubah/{id_keluar}', [BahanBakuKeluarController::class, 'formUbah'])->name('bahan-baku-keluar.form-ubah');
    Route::put('bahan-baku-keluar/ubah/{id_keluar}', [BahanBakuKeluarController::class, 'ubahBahanKeluar'])->name('bahan-baku-keluar.ubah');
    Route::delete('bahan-baku-keluar/hapus/{id_keluar}', [BahanBakuKeluarController::class, 'hapusBahanKeluar'])->name('bahan-baku-keluar.hapus');

    // BARANG SETENGAH JADI STOK
    Route::get('stok-barang-setengah-jadi', [StokBarangSetengahJadiController::class, 'show'])->name('stok-barang-setengah-jadi.show');

    // BARANG SETENGAH JADI MASUK
    Route::get('barang-setengah-jadi-masuk', [BarangSetengahJadiMasukController::class, 'show'])->name('barang-setengah-jadi-masuk.show');
    Route::get('barang-setengah-jadi-masuk/tambah', [BarangSetengahJadiMasukController::class, 'formTambah'])->name('barang-setengah-jadi-masuk.form-tambah');
    Route::post('barang-setengah-jadi-masuk/tambah/{kode_barang?}', [BarangSetengahJadiMasukController::class, 'tambahBarangMasuk'])->name('barang-setengah-jadi-masuk.tambah');
    Route::get('barang-setengah-jadi-masuk/ubah/{id}', [BarangSetengahJadiMasukController::class, 'formUbah'])->name('barang-setengah-jadi-masuk.form-ubah');
    Route::put('barang-setengah-jadi-masuk/ubah/{id}', [BarangSetengahJadiMasukController::class, 'ubahBarangMasuk'])->name('barang-setengah-jadi-masuk.ubah');
    Route::delete('barang-setengah-jadi-masuk/hapus/{id}', [BarangSetengahJadiMasukController::class, 'hapusBarangMasuk'])->name('barang-setengah-jadi-masuk.hapus');

    //BARANG SETENGAH JADI KELUAR
    Route::get('barang-setengah-jadi-keluar', [BarangSetengahJadiKeluarController::class, 'show'])->name('barang-setengah-jadi-keluar.show');
    Route::get('barang-setengah-jadi-keluar/tambah/{kode_barang}', [BarangSetengahJadiKeluarController::class, 'formTambah'])->name('barang-setengah-jadi-keluar.form-tambah');
    Route::post('barang-setengah-jadi-keluar/tambah/{kode_barang}', [BarangSetengahJadiKeluarController::class, 'tambahBarangKeluar'])->name('barang-setengah-jadi-keluar.tambah');
    Route::get('barang-setengah-jadi-keluar/ubah/{id}', [BarangSetengahJadiKeluarController::class, 'formUbah'])->name('barang-setengah-jadi-keluar.form-ubah');
    Route::put('barang-setengah-jadi-keluar/ubah/{id}', [BarangSetengahJadiKeluarController::class, 'ubahBarangKeluar'])->name('barang-setengah-jadi-keluar.ubah');
    Route::delete('barang-setengah-jadi-keluar/hapus/{id}', [BarangSetengahJadiKeluarController::class, 'hapusBarangKeluar'])->name('barang-setengah-jadi-keluar.hapus');

    // BARANG JADI STOK
    Route::get('stok-barang-jadi', [StokBarangJadiController::class, 'show'])->name('stok-barang-jadi.show');

    //BARANG JADI MASUK
    Route::get('barang-jadi-masuk', [BarangJadiMasukController::class, 'show'])->name('barang-jadi-masuk.show');
    Route::get('barang-jadi-masuk/tambah', [BarangJadiMasukController::class, 'formTambah'])->name('barang-jadi-masuk.form-tambah');
    Route::post('barang-jadi-masuk/tambah/{kode_barang?}', [BarangJadiMasukController::class, 'tambahBarangMasuk'])->name('barang-jadi-masuk.tambah');
    Route::get('barang-jadi-masuk/ubah/{id}', [BarangJadiMasukController::class, 'formUbah'])->name('barang-jadi-masuk.form-ubah');
    Route::put('barang-jadi-masuk/ubah/{id}', [BarangJadiMasukController::class, 'ubahBarangMasuk'])->name('barang-jadi-masuk.ubah');
    Route::delete('barang-jadi-masuk/hapus/{id}', [BarangJadiMasukController::class, 'hapusBarangMasuk'])->name('barang-jadi-masuk.hapus');

    //BARANG JADI KELUAR
    Route::get('barang-jadi-keluar', [BarangJadiKeluarController::class, 'show'])->name('barang-jadi-keluar.show');
    Route::get('barang-jadi-keluar/tambah/{kode_barang}', [BarangJadiKeluarController::class, 'formTambah'])->name('barang-jadi-keluar.form-tambah');
    Route::post('barang-jadi-keluar/tambah/{kode_barang?}', [BarangJadiKeluarController::class, 'tambahBarangKeluar'])->name('barang-jadi-keluar.tambah');
    Route::get('barang-jadi-keluar/ubah/{id}', [BarangJadiKeluarController::class, 'formUbah'])->name('barang-jadi-keluar.form-ubah');
    Route::put('barang-jadi-keluar/ubah/{id}', [BarangJadiKeluarController::class, 'ubahBarangKeluar'])->name('barang-jadi-keluar.ubah');
    Route::delete('barang-jadi-keluar/hapus/{id}', [BarangJadiKeluarController::class, 'hapusBarangKeluar'])->name('barang-jadi-keluar.hapus');

    // PEMESANAN BARANG JADI
    Route::get('pemesanan-barang-jadi', [PemesananBarangJadiController::class, 'show'])->name('pemesanan-barang-jadi.show');
    Route::get('pemesanan-barang-jadi/tambah', [PemesananBarangJadiController::class, 'formTambah'])->name('pemesanan-barang-jadi.form-tambah');
    Route::post('pemesanan-barang-jadi/tambah', [PemesananBarangJadiController::class, 'tambah'])->name('pemesanan-barang-jadi.tambah');
    Route::get('pemesanan-barang-jadi/ubah/{id_pesanan}', [PemesananBarangJadiController::class, 'formUbah'])->name('pemesanan-barang-jadi.form-ubah');
    Route::put('pemesanan-barang-jadi/ubah/{id_pesanan}', [PemesananBarangJadiController::class, 'ubah'])->name('pemesanan-barang-jadi.ubah');
    Route::delete('pemesanan-barang-jadi/hapus/{id_pesanan}', [PemesananBarangJadiController::class, 'hapusPemesanan'])->name('pemesanan-barang-jadi.hapus');
    Route::get('pemesanan-barang-jadi/hitung/{id_pesanan}', [PemesananBarangJadiController::class, 'hitung'])->name('pemesanan-barang-jadi.hitung');

    //DETAIL PEMESANAN BARANG JADI
    Route::delete('detail-pemesanan-barang-jadi/hapus/{id_detail}', [PemesananBarangJadiController::class, 'hapusDetail'])->name('detail-pemesanan-barang-jadi.hapus');

    // DATA BAHAN BAKU
    Route::get('bahan-baku', [BahanBakuController::class, 'show'])->name('bahan-baku.show');
    Route::get('bahan-baku/tambah', [BahanBakuController::class, 'formTambah'])->name('bahan-baku.form-tambah');
    Route::post('bahan-baku/tambah', [BahanBakuController::class, 'tambahBahan'])->name('bahan-baku.tambah');
    Route::get('bahan-baku/ubah/{id}', [BahanBakuController::class, 'formUbah'])->name('bahan-baku.form-ubah');
    Route::put('bahan-baku/ubah/{id}', [BahanBakuController::class, 'ubahBahan'])->name('bahan-baku.ubah');
    Route::delete('bahan-baku/hapus/{id}', [BahanBakuController::class, 'hapusBahan'])->name('bahan-baku.hapus');

    //DATA BARANG SETENGAH JADI
    Route::get('barang-setengah-jadi', [BarangSetengahJadiController::class, 'show'])->name('barang-setengah-jadi.show');
    Route::get('barang-setengah-jadi/tambah', [BarangSetengahJadiController::class, 'formTambah'])->name('barang-setengah-jadi.form-tambah');
    Route::post('barang-setengah-jadi/tambah', [BarangSetengahJadiController::class, 'tambahBarang'])->name('barang-setengah-jadi.tambah');
    Route::get('barang-setengah-jadi/ubah/{id}', [BarangSetengahJadiController::class, 'formUbah'])->name('barang-setengah-jadi.form-ubah');
    Route::put('barang-setengah-jadi/ubah/{id}', [BarangSetengahJadiController::class, 'ubahBarang'])->name('barang-setengah-jadi.ubah');
    Route::delete('barang-setengah-jadi/hapus/{id}', [BarangSetengahJadiController::class, 'hapusBarang'])->name('barang-setengah-jadi.hapus');

    //DATA BARANG JADI
    Route::get('barang-jadi', [BarangJadiController::class, 'show'])->name('barang-jadi.show');
    Route::get('barang-jadi/tambah', [BarangJadiController::class, 'formTambah'])->name('barang-jadi.form-tambah');
    Route::post('barang-jadi/tambah', [BarangJadiController::class, 'tambahBarang'])->name('barang-jadi.tambah');
    Route::get('barang-jadi/ubah/{id}', [BarangJadiController::class, 'formUbah'])->name('barang-jadi.form-ubah');
    Route::put('barang-jadi/ubah/{id}', [BarangJadiController::class, 'ubahBarang'])->name('barang-jadi.ubah');
    Route::delete('barang-jadi/hapus/{id}', [BarangJadiController::class, 'hapusBarang'])->name('barang-jadi.hapus');

    //DATA CUSTOMER
    Route::get('customer', [CustomerController::class, 'show'])->name('customer.show');
    Route::get('customer/tambah', [CustomerController::class, 'formTambah'])->name('customer.form-tambah');
    Route::post('customer/tambah', [CustomerController::class, 'tambahCustomer'])->name('customer.tambah');
    Route::get('customer/ubah/{id}', [CustomerController::class, 'formUbah'])->name('customer.form-ubah');
    Route::put('customer/ubah/{id}', [CustomerController::class, 'ubahCustomer'])->name('customer.ubah');
    Route::delete('customer/hapus/{id}', [CustomerController::class, 'hapusCustomer'])->name('customer.hapus');

    //DATA POTONGAN
    Route::get('potongan', [PotonganController::class, 'show'])->name('potongan.show');
    Route::get('potongan/tambah', [PotonganController::class, 'formTambah'])->name('potongan.form-tambah');
    Route::post('potongan/tambah', [PotonganController::class, 'tambahPotongan'])->name('potongan.tambah');
    Route::get('potongan/ubah/{id}', [PotonganController::class, 'formUbah'])->name('potongan.form-ubah');
    Route::put('potongan/ubah/{id}', [PotonganController::class, 'ubahPotongan'])->name('potongan.ubah');
    Route::delete('potongan/hapus/{id}', [PotonganController::class, 'hapusPotongan'])->name('potongan.hapus');

    //DATA KEBUTUHAN BARANG JADI
    Route::get('barang-jadi/{id}/kebutuhan', [BarangJadiController::class, 'kebutuhanForm'])->name('barang-jadi.kebutuhan_form');
    Route::post('barang-jadi/{id}/kebutuhan', [BarangJadiController::class, 'kebutuhanTambah'])->name('barang-jadi.kebutuhan_tambah');
    Route::delete('barang-jadi/{id}/kebutuhan/{kebutuhan_id}', [BarangJadiController::class, 'kebutuhanHapus'])->name('barang-jadi.kebutuhan_hapus');
});

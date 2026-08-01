<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// Panggil Model Barang yang tadi kita buat
use App\Models\Barang; 
use App\Models\Kategori;


class BarangController extends Controller
{
  
      public function index(Request $request)
{
    // Ambil kata kunci pencarian dari input user
    $cari = $request->get('cari');

    if($cari) {
        // Jika user mencari sesuatu, filter berdasarkan nama barang
        $data_barang = Barang::where('nama_barang', 'LIKE', '%' . $cari . '%')->get();
    } else {
        // Jika tidak, tampilkan semua data seperti biasa
        $data_barang = Barang::all();
    }

    return view('barang', ['data_barang' => $data_barang]);
    }
  
          // Ubah nama fungsinya menjadi 'create' agar sesuai dengan Route
    public function create()
    {
        // Ambil semua data kategori dari database
        $kategoris = Kategori::all();
        
        // Bawa data tersebut ke halaman form tambah
        return view('barang-tambah', ['kategoris' => $kategoris]);
    }

    public function store(Request $request)
    {
        // 1. Validasi (tambah aturan untuk foto)
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        // 2. Simpan Data
        $barang = new Barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->kategori_id = $request->kategori_id;
        $barang->harga = $request->harga;
        $barang->stok = $request->stok;

        // 3. Logika Upload Foto
        if ($request->hasFile('foto')) {
            // Simpan foto ke folder 'storage/app/public/foto-barang'
            $path = $request->file('foto')->store('foto-barang', 'public');
            // Simpan path/lokasinya ke database
            $barang->foto = $path;
        }

        $barang->save();

        return redirect()->back()->with('success', 'Data: "' . $request->nama_barang . '" Telah Disimpan');
    }

        public function destroy($id)
    {
        // 1. Pengecekan Hak Akses: Hanya Admin yang boleh menghapus!
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak: Anda tidak memiliki izin untuk menghapus data!');
        }

        // 2. Proses hapus jalan seperti biasa jika dia admin
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang');
    }

    // --- FUNGSI UNTUK MENAMPILKAN HALAMAN EDIT ---
        public function edit($id)
    {
        // 1. Cari data barang yang mau diedit
        $barang = Barang::findOrFail($id);
        
        // 2. KODE PENYELAMAT: Ambil semua data kategori dari database
        $kategoris = Kategori::all();
        
        // 3. Kirim kedua data tersebut ke file view edit
        return view('barang-edit', [
            'barang'    => $barang,
            'kategoris' => $kategoris
        ]);
    }

    // --- FUNGSI UNTUK MENYIMPAN PERUBAHAN EDIT KE DATABASE ---
     public function update(Request $request, $id)
 {
     // 1. Tambahkan validasi foto
     $request->validate([
         'nama_barang' => 'required|string|max:255',
         'kategori_id' => 'required',
         'harga'       => 'required|numeric|min:0',
         'stok'        => 'required|integer|min:0',
         'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
     ]);

     $barang = Barang::findOrFail($id);
     $barang->nama_barang = $request->nama_barang;
     $barang->kategori_id = $request->kategori_id;
     $barang->harga = $request->harga;
     $barang->stok = $request->stok;

     // 2. Logika Ajaib: Cek apakah user mengupload foto baru?
     if ($request->hasFile('foto')) {

         // a. Jika data barang ini sebelumnya sudah punya foto, HAPUS foto lamanya dari memori!
         if ($barang->foto) {
             Storage::disk('public')->delete($barang->foto);
         }

         // b. Simpan foto barunya, lalu catat nama file barunya di database
         $path = $request->file('foto')->store('foto-barang', 'public');
         $barang->foto = $path;
     }

     $barang->save();

     return redirect()->route('barang');
 }


}

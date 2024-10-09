<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\tbl_barang;
use App\Models\tbl_akun;
use Illuminate\Support\Facades\Log;

class BarangController extends Controller
{
    public function daftarbarang(Request $request)
    {
        $id = $request->query('id');
        $akun = tbl_akun::find($id);
    
        if (!$akun) {
            return redirect('/login')->withErrors(['msg' => 'User not found.']);
        }
    
        $dataBrg = tbl_barang::all();
    
        if ($request->has('cari')) {
            $keyword = $request->input('keyword');
            $dataBrg = tbl_barang::where('namaBarang', 'LIKE', "%$keyword%")->get();
        }
    
        return view('daftarbarang', compact('akun', 'dataBrg'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaBarang' => 'required|string|max:255',
            'hargaBarang' => 'required|integer',
            'stokBarang' => 'required|integer',
            'fotoBarang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $barang = new tbl_barang();
        $barang->namaBarang = $request->input('namaBarang');
        $barang->hargaBarang = $request->input('hargaBarang');
        $barang->stokBarang = $request->input('stokBarang');

        // Handle foto jika ada
        if ($request->hasFile('fotoBarang')) {
            $fotoFileName = $request->file('fotoBarang')->getClientOriginalName();
            $request->file('fotoBarang')->storeAs('imgBarang', $fotoFileName, 'public');
            $barang->fotoBarang = $fotoFileName;
        }

        $barang->save();

        return redirect()->route('daftarbarang', ['id' => $request->input('id')]);
    }
    public function delete($idBarang, $id)
{
    // Mencari akun berdasarkan ID
    $akun = tbl_akun::find($id);
    if (!$akun) {
        return redirect()->back()->withErrors(['msg' => 'Data akun tidak ditemukan.']);
    }

    // Mencari barang berdasarkan ID
    $barang = tbl_barang::find($idBarang);
    if (!$barang) {
        return redirect()->route('daftarbarang', ['id' => $id])->withErrors(['msg' => 'Data barang tidak ditemukan.']);
    }

    // Jika barang memiliki foto, hapus dari penyimpanan
    if ($barang->fotoBarang) {
        \Storage::disk('public')->delete('imgBarang/' . $barang->fotoBarang);
    }

    // Menghapus data barang dari database
    $barang->delete();

    // Redirect ke daftar barang dengan pesan sukses
    return redirect()->route('daftarbarang', ['id' => $id])->with('success', 'Item berhasil dihapus.');
}



    public function create(Request $request)
    {
        $id = $request->query('id');
        $akun = tbl_akun::find($id);

        if (!$akun) {
            return redirect('/login')->withErrors(['msg' => 'User not found.']);
        }

        return view('barang.tambah', compact('akun'));
    }

  

public function edit($idBarang, $id)
{
    // Logging untuk melihat parameter yang diterima
    Log::info('Mengakses edit barang dengan idBarang: ' . $idBarang . ' dan id: ' . $id);

    
    // Mencari akun berdasarkan ID
    $akun = tbl_akun::find($id);
    if (!$akun) {
        return redirect()->back()->withErrors(['msg' => 'Data akun tidak ditemukan.']);
    }

    // Mencari barang berdasarkan idBarang
    $barang = tbl_barang::find($idBarang);
    if (!$barang) {
        return redirect()->back()->withErrors(['msg' => 'Data barang tidak ditemukan.']);
    }

    // Mengembalikan tampilan edit barang dengan data akun dan barang
    return view('barang.ubah', compact('akun', 'barang'));
}

    
    public function update(Request $request, $idBarang, $id)
    {
        // Validasi
        $request->validate([
            'namaBarang' => 'required|string|max:255',
            'hargaBarang' => 'required|numeric',
            'stokBarang' => 'required|integer',
            'fotoBarang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $barang = tbl_barang::find($idBarang);
        if (!$barang) {
            return redirect()->back()->withErrors(['msg' => 'Data barang tidak ditemukan.']);
        }
    
        // Update data barang
        $barang->namaBarang = $request->namaBarang;
        $barang->hargaBarang = $request->hargaBarang;
        $barang->stokBarang = $request->stokBarang;
    
        // Mengelola foto jika ada
        if ($request->hasFile('fotoBarang')) {
            $fotoFileName = $request->file('fotoBarang')->getClientOriginalName();
            $request->file('fotoBarang')->storeAs('imgBarang', $fotoFileName, 'public');
            $barang->fotoBarang = $fotoFileName;
        }
    
        $barang->save();
    
        return redirect()->route('daftarbarang', ['id' => $id])  // Arahkan kembali ke daftar barang
                         ->with('success', 'Data barang berhasil diupdate.');
    }
    

}

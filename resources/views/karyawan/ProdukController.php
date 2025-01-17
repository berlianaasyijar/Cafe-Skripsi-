<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::where('status', 1)->get();
        return view('produk/produk-data', compact('produk'));
    }

    public function create()
    {
        return view('produk/produk-tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $filePath = $file->store('uploads', 'public');
        }

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar_produk' => $filePath,
            'status' => 1,
            'creaby' => auth()->user()->name ?? 'system', // Adjust based on your authentication setup
            'creadate' => now(),
        ]);

        return redirect()->route('produk/produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }
    public function edit($id)
    {
        // Mengambil data produk berdasarkan ID
        $produk = Produk::findOrFail($id);

        // Mengarahkan ke view 'produk-edit' dan mengirimkan data produk
        return view('produk.produk-edit', compact('produk'));
    }
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $filePath = $file->store('uploads', 'public');
            $produk->gambar_produk = $filePath;
        }

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'updatedby' => auth()->user()->name ?? 'system',
            'updateddate' => now(),
        ]);

        return redirect()->route('produk/produk.index')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->update(['status' => 0]);
        return redirect()->route('produk/produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}

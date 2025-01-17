<?php
// app/Http/Controllers/KaryawanController.php
namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    // Method untuk menyimpan karyawan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:karyawans',
            'no_hp' => 'required|string|max:15',
            'point' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('karyawan_fotos', 'public');
        }

        Karyawan::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'no_hp' => $request->no_hp,
            'point' => $request->point,
            'foto' => $fotoPath,
            'status' => 1,
            'created_by' => auth()->user()->id,
            'created_date' => now(),
        ]);

        return redirect()->route('karyawans.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    // Method untuk memperbarui karyawan
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:karyawans,username,' . $karyawan->id,
            'no_hp' => 'required|string|max:15',
            'point' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($karyawan->foto) {
                Storage::disk('public')->delete($karyawan->foto);
            }
            $karyawan->foto = $request->file('foto')->store('karyawan_fotos', 'public');
        }

        $karyawan->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'no_hp' => $request->no_hp,
            'point' => $request->point,
            'foto' => $karyawan->foto,
            'updated_by' => auth()->user()->id,
            'updated_date' => now(),
        ]);

        return redirect()->route('karyawans.index')->with('success', 'Karyawan berhasil diperbarui.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Member;

use Illuminate\Support\Facades\Session;
class HomeController extends Controller
{
    public function index()
    {
        // Mengambil jumlah total produk dengan status 1
        $totalMenu = Produk::where('status', 1)->count();

        // Mengambil daftar menu dengan status 1
        $listMenu = Produk::where('status', 1)->get();

        // Mengambil jumlah total member dengan status 1
        $totalMember = Member::where('status', 1)->count();

        // Mengirim data ke view
        return view('index', compact('totalMenu', 'listMenu', 'totalMember'));
    }
    public function profil()
    {
        // Pastikan session memiliki data karyawan
        if (!Session::has('karyawan_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data karyawan dari session
        $karyawan = [
            'id' => Session::get('karyawan_id'),
            'nama' => Session::get('karyawan_nama'),
            'foto' => Session::get('karyawan_foto'),
            'email' => Session::get('karyawan_email'),
            'no_hp' => Session::get('karyawan_no_hp'),
        ];

        // Tampilkan view profil
        return view('profil.users-profile', compact('karyawan'));
    }
}

<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;  // Sesuaikan dengan model yang Anda gunakan
use Hash;

class RegisterController extends Controller
{
    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('login.pages-register');
    }
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',  // Pastikan tabel karyawans sudah ada
            'password' => 'required|string|confirmed',
       
            'email' => 'required|email',
            'no_hp' => 'required|string',
        ]);
        $filePath = null;
            $file = $request->file('foto');
            $filePath = $file->store('uploads', 'public');
        
        // Menyimpan data ke database
        $karyawan = new Karyawan();
        $karyawan->nama= $request->name;
        $karyawan->username = $request->username;
        $karyawan->password = $request->password;
        //  $karyawan->role = $request->role;
         $karyawan->foto =  $filePath;
        $karyawan->email = $request->email;
        $karyawan->no_hp = $request->no_hp;
    
        $karyawan->save();
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
}

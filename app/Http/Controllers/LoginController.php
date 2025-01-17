<?
namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // return view('login.pages-login');  // Menampilkan form login
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|string', // Admin / User
        ]);

        // Ambil data karyawan berdasarkan username
        $karyawan = Karyawan::where('username', $request->username)->first();

        // Cek apakah karyawan ditemukan dan password cocok
        if ($karyawan && Hash::check($request->password, $karyawan->password)) {
            // Simpan informasi ke session (id dan nama)
            Session::put('karyawan_id', $karyawan->id);
            Session::put('karyawan_nama', $karyawan->nama);
            // Session::put('karyawan_role', $request->role);
            Session::put('karyawan_foto', $request->foto);
            Session::put('karyawan_email', $request->email);
            Session::put('karyawan_no_hp', $request->no_hp);
            // Redirect berdasarkan role
            if ($request->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return redirect()->back()->with('error', 'Invalid username or password!');
    }

    public function logout()
    {
        // Menghapus session dan melakukan logout
        Session::flush();
        return redirect()->route('login');
    }
}

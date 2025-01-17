<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;
use App\Models\Karyawan;
class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login.pages-login');  // Menampilkan tampilan login
    }
    public function showLoginUserForm()
    {
        return view('login.pages-login-user');  // Menampilkan tampilan login
    }
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Fetch Karyawan data based on username
        $karyawan = Karyawan::where('username', $request->username)
        ->where('password', $request->password)
        ->first();
        print_r($request->password);
        print_r($request->username);
        // Check if user exists and password matches
        if ($karyawan) {
            // Store session data
            Session::put('karyawan_id', $karyawan->id);
            Session::put('karyawan_nama', $karyawan->nama);
            Session::put('karyawan_foto', $karyawan->foto ? asset('storage/' . $karyawan->foto) : null); 
            Session::put('karyawan_email', $karyawan->email);
            Session::put('karyawan_no_hp', $karyawan->no_hp);
            Session::put('karyawan_role', "Admin");
            // Redirect based on role
            // if ($request->role == 'Admin') {
                return redirect()->route('dashboard');
            // } else {
                // return redirect()->route('user.dashboard');
            // }
        }

        // If login fails, return with error message
     return redirect()->back()->with('error', 'Invalid username, password, or role!');
    }
    public function loginUser(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string'
        ]);

        // Fetch Karyawan data based on username
        $member = Member::where('username', $request->username)
        ->where('no_hp', $request->no_hp)
        ->where('status', 1)
        ->first();
        print_r($request->password);
        print_r($request->username);
        // Check if user exists and password matches
        if ($member) {
            // Store session data
            Session::put('karyawan_id', $member->id);
            Session::put('karyawan_nama', $member->nama);
            Session::put('karyawan_foto', $member->foto);
            Session::put('karyawan_email', $member->email);
            Session::put('karyawan_no_hp', $member->no_hp);
            Session::put('karyawan_level', $member->level);
            Session::put('karyawan_points', $member->points);
            Session::put('karyawan_role', "User");
    
            return redirect()->route('points.index');

   
        }

        // If login fails, return with error message
     return redirect()->back()->with('error', 'Invalid username, password, or role!');
    }
    // Menangani proses logout
    public function logout()
    {
        // Hapus session dan logout
        Auth::logout();
        Session::flush();

        // Redirect ke halaman login
        return redirect()->route('login');
    }
}

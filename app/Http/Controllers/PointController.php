<?php

namespace App\Http\Controllers;
use App\Models\Member;
use App\Models\Point;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
class PointController extends Controller
{
    public function index()
    {
        $userId = session('karyawan_id'); // Mengambil ID pengguna yang sedang login
        $member = Member::where('id', $userId)->first();
    
        // Pastikan data member ditemukan
        if (!$member) {
            return redirect()->back()->with('error', 'Data member tidak ditemukan.');
        }
    
        // Ambil kolom point dari member
        $points = $member->point;
        
        // Menentukan pointsRequired berdasarkan jumlah poin
        $pointsUsed = 0;
    
        if ($points > 300) {
            $pointsUsed = 400; // Platinum
        } elseif ($points > 200) {
            $pointsUsed = 300; // Gold
        } elseif ($points > 100) {
            $pointsUsed = 200; // Silver
        } else {
            $pointsUsed = 100; // Bronze
        }
    
        // Menentukan persentase progress menuju level berikutnya
        $progressPercentage = min(100, ($points / $pointsUsed) * 100);
    
        return view('point.point', [
            'points' => $points,
            'pointsRequired' => $pointsUsed,
            'progressPercentage' => $progressPercentage,
        ]);
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'reason' => 'required|string|max:255',
            'points' => 'required|integer',
        ]);

        Point::create([
            'id_member' => auth()->id(), // Assuming `auth` is used for member login
            'total_point' => $request->points,
            'created_by' => auth()->user()->name ?? 'System',
        ]);

        return redirect()->route('points.index')->with('success', 'Point berhasil ditukar.');
    }
}

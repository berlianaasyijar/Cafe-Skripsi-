<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Member;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaksi::with('details')->orderBy('status', 'desc')->get();
        return view('transaksi.index', compact('transactions'));
    }
    

    public function show($id)
    {   
        // Ambil detail transaksi berdasarkan ID transaksi
        $transaction = Transaksi::with('details')->findOrFail($id);
        return view('transaksi.show', compact('transaction'));
    }

    public function approve($id)
    {
        $transaction = Transaksi::findOrFail($id);
    
        // Update status transaksi menjadi berhasil
        $transaction->update(['status' => 1]);
    
        // Update poin member
        $member = Member::where('id', session('karyawan_id'))->first();
        if ($member) {
            $member->point += $member->add_point; // Tambahkan add_point ke point
            $member->add_point = 0; // Reset add_point menjadi 0
            
            // Update level member berdasarkan poin
            if ($member->point > 300) {
                $member->level = 'Platinum';
            } elseif ($member->point > 200) {
                $member->level = 'Gold';
            } elseif ($member->point > 100) {
                $member->level = 'Silver';
            } else {
                $member->level = 'Bronze';
            }
    
            $member->save(); // Simpan perubahan
        }
    
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disetujui.');
    }
    
    
}
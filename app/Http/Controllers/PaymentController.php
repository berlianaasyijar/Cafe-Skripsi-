<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi; // Import model Transaksi
use App\Models\DetailTransaksi;
use App\Models\Member;
class PaymentController extends Controller
{
    public function index()
    {
        
        return view('menu.payment');
    }

/*************  ✨ Codeium Command ⭐  *************/
/******  6992abed-4106-47e3-8abc-8a76b25a4d63  *******/
public function submitPayment(Request $request)
{
    $request->validate([
        'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'total_price' => 'required|numeric',
        'redeem_level' => 'nullable|in:Bronze,Silver,Gold,Platinum',
    ]);

    // Simpan bukti pembayaran
    $paymentProof = $request->file('payment_proof')->store('payments', 'public');

    // Simpan transaksi
    $transaksi = Transaksi::create([
        'total_harga' => $request->total_price,
        'bukti_pembayaran' => $paymentProof,
        'created_by' => session('karyawan_id'), // Perbaikan session
        'status' => 2,
    ]);

    // Simpan detail transaksi
    $cart = json_decode($request->input('cart'), true) ?? [];
    foreach ($cart as $item) {
        DetailTransaksi::create([
            'transaksi_id' => $transaksi->id, // Sesuaikan dengan nama kolom di database
            'produk_id' => $item['id'],
            'jumlah' => $item['quantity'],
        ]);
    }

    // Tambah poin berdasarkan total harga
    $totalPrice = $request->total_price;
    $points = 0;

    if ($totalPrice >= 50000) {
        if ($totalPrice <= 100000) {
            // 1 poin setiap 5k dari 50k - 100k
            $points = floor(($totalPrice - 50000) / 5000);
        } else {
            // 1 poin setiap 5k dari 50k - 100k
            $points = floor((100000 - 50000) / 5000);

            // 1.5 poin setiap 5k untuk >100k
            $extraPoints = ($totalPrice - 100000) / 5000 * 1.5;
            $points += floor($extraPoints);
        }
    }

    // Update poin member
    $member = Member::where('id', session('karyawan_id'))->first();
    if ($member) {
        $member->add_point += $points; // Tambahkan poin yang dihitung
        $member->save();
    }

    // Update poin member berdasarkan penukaran
    $redeemedLevel = $request->input('redeem_level'); // Level yang dipilih
    $pointsUsed = 0;

    if ($redeemedLevel === 'Bronze') $pointsUsed = 100;
    if ($redeemedLevel === 'Silver') $pointsUsed = 200;
    if ($redeemedLevel === 'Gold') $pointsUsed = 300;
    if ($redeemedLevel === 'Platinum') $pointsUsed = 400;

    if ($member) {
        $member->point -= $pointsUsed; // Kurangi poin jika ada penukaran
        $member->save();
    }

    return redirect()->route('thank-you')->with('success', 'Transaksi berhasil! Poin diperbarui.');
}


    public function thankYou()
    {
        return view('thank-you');
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Member;
use App\Models\Produk;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // public function index($kategori = null)
    // {
    //     $query = Produk::where('status', 'active');
        
    //     // if ($kategori) {
    //     //     $query->where('kategori', $kategori);
    //     // }
        
    //     $products = $query->get();
        
    //     return view('menu.menu', [
    //         'products' => $products
    //     ]);
    // }
    public function index()
    {
        $products = Produk::where('status', 1)->get();
        $categories = ['Makanan', 'Minuman', 'Camilan']; // Pastikan kategori disesuaikan dengan data
    
        return view('menu.menu', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
    public function transaction()
{
      // Ambil member berdasarkan session karyawan_id
      $member = Member::where('id', session('karyawan_id'))->first();

      // Hitung poin yang dapat ditukar
      $redeemableLevels = [];
      if ($member && $member->point >= 100) {
          if ($member->point >= 100) {
              $redeemableLevels['Bronze'] = 10; // Potongan 10% untuk 100 poin
          }
          if ($member->point >= 200) {
              $redeemableLevels['Silver'] = 20; // Potongan 20% untuk 200 poin
          }
          if ($member->point >= 300) {
              $redeemableLevels['Gold'] = 30; // Potongan 30% untuk 300 poin
          }
          if ($member->point >= 400) {
              $redeemableLevels['Platinum'] = 40; // Potongan 40% untuk 400 poin
          }
      }
    return view('menu.transaction', [
        'member' => $member,
        'redeemableLevels' => $redeemableLevels,
    ]);
}
    
}
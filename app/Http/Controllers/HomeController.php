<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKegiatanModels;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $count_lk = LaporanKegiatanModels::count();
        // $count_lk_acc = LaporanKegiatanModels::where('laporan_kegiatan.id_approve', '=', '2')->count();
        // $count_lk_pend = LaporanKegiatanModels::where('laporan_kegiatan.id_approve', '=', '1')->count();
        // //$count_users = User::count();

        $role = Auth::user()->id_level;
        if ($role != 2) {
        $count_lk = LaporanKegiatanModels::count();
        $count_lk_acc = LaporanKegiatanModels::where('laporan_kegiatan.id_approve', '=', '2')->count();
        $count_lk_pend = LaporanKegiatanModels::where('laporan_kegiatan.id_approve', '=', '1')->count();
        $count_users = User::count();

        }else{
            $user_id = Auth::id();
            $count_lk = LaporanKegiatanModels::where('laporan_kegiatan.id_karyawan', '=', $user_id)->count();
            $count_lk_acc = LaporanKegiatanModels::where('laporan_kegiatan.id_approve', '=', '2')->where('laporan_kegiatan.id_karyawan', '=', $user_id)->count();
            $count_lk_pend = LaporanKegiatanModels::where('laporan_kegiatan.id_approve', '=', '1')->where('laporan_kegiatan.id_karyawan', '=', $user_id)->count();
            $count_users = User::count();  
        }
        //dd($count_lk_acc);
           return view('dashboard',[
            'title' => 'Dashboard'
            
           ],compact('count_lk','count_lk_acc','count_lk_pend','count_users')
    );
    }
}

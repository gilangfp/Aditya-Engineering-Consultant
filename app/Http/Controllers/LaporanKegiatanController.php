<?php

namespace App\Http\Controllers;

use PDF;
use File;
use Response;
use App\Models\SubModels;
use App\Models\ProyekModels;
use Illuminate\Http\Request;
use App\Models\ApproveModels;
use App\Models\KaryawanModels;
use App\Models\LaporanKegiatan;
use App\Models\DepartemenModels;
use App\Models\JeniskegiatanModels;
use App\Models\TahunanggaranModels;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\LaporanKegiatanModels;

class LaporanKegiatanController extends Controller
{
    public function index()
    {
        // $laporanKegiatan = LaporanKegiatanModels::with('proyek', 'user', 'jeniskegiatan.sub.departemen')
        // ->select('laporan_kegiatan.*')
        // ->get();
        // dd($laporanKegiatan);
        $role = Auth::user()->id_level;
        $acc = ApproveModels::all();
        if ($role == 1) {
            $laporankegiatan = LaporanKegiatanModels::join('proyek', 'laporan_kegiatan.id_proyek', '=', 'proyek.id')
            ->join('tahun_anggaran', 'tahun_anggaran.id_tahun', '=', 'proyek.id_tahun')
            ->join('users', 'users.id', '=', 'laporan_kegiatan.id_karyawan')
            ->join('jenis_kegiatan', 'jenis_kegiatan.id_jenis', '=', 'laporan_kegiatan.id_jenis')
            ->join('sub', 'jenis_kegiatan.id_sub', '=', 'sub.id_sub')
            ->join('departemen', 'sub.id', '=', 'departemen.id')
            ->join('approve', 'laporan_kegiatan.id_approve', '=', 'approve.id_approve')
            
            ->get(['laporan_kegiatan.*','users.name','proyek.kode_proyek','proyek.nama_proyek','tahun_anggaran.tahun','jenis_kegiatan.nama_kegiatan','departemen.nama_departemen'
        ,'approve.nama']);  
        }elseif ($role == 3){
            $laporankegiatan = LaporanKegiatanModels::join('proyek', 'laporan_kegiatan.id_proyek', '=', 'proyek.id')
            ->join('tahun_anggaran', 'tahun_anggaran.id_tahun', '=', 'proyek.id_tahun')
            ->join('users', 'users.id', '=', 'laporan_kegiatan.id_karyawan')
            ->join('jenis_kegiatan', 'jenis_kegiatan.id_jenis', '=', 'laporan_kegiatan.id_jenis')
            ->join('sub', 'jenis_kegiatan.id_sub', '=', 'sub.id_sub')
            ->join('departemen', 'sub.id', '=', 'departemen.id')
            ->join('approve', 'laporan_kegiatan.id_approve', '=', 'approve.id_approve')
            ->where('laporan_kegiatan.id_approve', '=', '2')
            ->get(['laporan_kegiatan.*','users.name','proyek.kode_proyek','proyek.nama_proyek','tahun_anggaran.tahun','jenis_kegiatan.nama_kegiatan','departemen.nama_departemen'
        ,'approve.nama']);
            
        }
    else{
            $user_id = Auth::id();
            $laporankegiatan = LaporanKegiatanModels::join('proyek', 'laporan_kegiatan.id_proyek', '=', 'proyek.id')
            ->join('tahun_anggaran', 'tahun_anggaran.id_tahun', '=', 'proyek.id_tahun')
            ->join('users', 'users.id', '=', 'laporan_kegiatan.id_karyawan')
            ->where('users.id', '=', $user_id)
            ->join('jenis_kegiatan', 'jenis_kegiatan.id_jenis', '=', 'laporan_kegiatan.id_jenis')
            ->join('sub', 'jenis_kegiatan.id_sub', '=', 'sub.id_sub')
            ->join('departemen', 'sub.id', '=', 'departemen.id')
            ->join('approve', 'laporan_kegiatan.id_approve', '=', 'approve.id_approve')
            ->get(['laporan_kegiatan.*','users.name','proyek.kode_proyek','proyek.nama_proyek','tahun_anggaran.tahun','jenis_kegiatan.nama_kegiatan','departemen.nama_departemen'
        ,'approve.nama']);
        }


        return view(
            'laporankegiatan.index',
            [
                'title' => 'Laporan-kegiatan'
            ],
            compact('laporankegiatan','acc')
        );
        }


    // public function test()
    //     {
    //         $data['departemen'] = DepartemenModels::get(["nama_departemen", "id"]);
    //         return view('dropdown', $data);
    //     }

    // public function fetchState(Request $request)
    //     {
    //         $data['sub'] = SubModels::where("id", $request->id)
    //                                 ->get(["nama_sub", "id_sub"]);
      
    //         return response()->json($data);
    //     }  
    // public function fetchCity(Request $request)
    // {
    //     $data['jenis_kegiatan'] = JeniskegiatanModels::where("id_sub", $request->id_sub)
    //                                 ->get(["nama_kegiatan", "id_sub"]);
                                      
    //     return response()->json($data);
    // } 
    
    
   // insert

    public function tambahlaporankegiatan()
    {
        $proyek = ProyekModels::all();
        $karyawan = KaryawanModels::all();
        $departemen = DepartemenModels::all();
        $jenis_kegiatan = JeniskegiatanModels::all();
        $tahunanggaran = TahunanggaranModels::all();
        return view(
            'laporankegiatan.tambahlaporankegiatan',
            [
                'title' => 'Tambah-Laporan-Kegiatan-page'
            ],
            compact('proyek','karyawan','departemen','jenis_kegiatan','tahunanggaran')
        );
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            "id_karyawan" => ['required'],
            "id_proyek" => ['required'],
            "id_jenis" => ['required'],
            "deskripsi" => ['required'],
            "dokumentasi" => ['required'],
            "id_approve" => ['required'],
            // "start" => ['required'],
            // "target" => ['required'],
        ]);
        // $karyawan = KaryawanModel::find($request);
        //dd($request);
        $idKaryawan = $request->get('id_karyawan');
        $karyawan = KaryawanModels::find($idKaryawan);
         
        
        if ($request->hasFile('dokumentasi')) {
            $dokumen = $request->file('dokumentasi');
            $nama_dokumen = 'AEC' .date('Ymdhis'). $karyawan->name . '.' . $dokumen->getClientOriginalExtension();
            $dokumen->move('dokumen/', $nama_dokumen);
    
            LaporanKegiatanModels::create($request->except(['_token', 'submit', 'updated_at', 'created_at', 'dokumentasi','id','id_sub','id_tahun']) + ['dokumentasi' => $nama_dokumen]);
    
            return redirect('laporankegiatan')->with('success', 'File uploaded successfully!');
        }
    
        return redirect('laporankegiatan')->with('error', 'No file selected.');
    }

    //update
    public function ubah($id)
    {
        // $laporankegiatan = LaporanKegiatanModels::find($id);
        $proyek = ProyekModels::all();
        $sub = SubModels::all();
        $departemen = DepartemenModels::all();
        $jenis_kegiatan = JeniskegiatanModels::all();
        $tahunanggaran = TahunanggaranModels::all();
        $laporankegiatan = LaporanKegiatanModels::join('proyek', 'laporan_kegiatan.id_proyek', '=', 'proyek.id')
        ->join('tahun_anggaran', 'tahun_anggaran.id_tahun', '=', 'proyek.id_tahun')
        ->join('users', 'users.id', '=', 'laporan_kegiatan.id_karyawan')
            ->join('jenis_kegiatan', 'jenis_kegiatan.id_jenis', '=', 'laporan_kegiatan.id_jenis')
            ->join('sub', 'jenis_kegiatan.id_sub', '=', 'sub.id_sub')
            ->join('departemen', 'sub.id', '=', 'departemen.id')
        ->where('laporan_kegiatan.id', '=', $id)
        ->get(['laporan_kegiatan.*','users.name','proyek.kode_proyek','proyek.nama_proyek','jenis_kegiatan.nama_kegiatan','departemen.nama_departemen','tahun_anggaran.tahun']);
        // dd($laporankegiatan);
        return view(
            'laporankegiatan.ubah',
            [
                'title' => 'ubah-laporankegiatan-page'
            ],
            compact('laporankegiatan','proyek','departemen','jenis_kegiatan','sub','tahunanggaran')
        );
    }

   
    public function update($id,Request $request)
    {
        //dd($request);
        $request->validate([
            "id_karyawan" => ['required'],
            "id_proyek" => ['required'],
            "id_jenis" => ['required'],
            "deskripsi" => ['required'],
            // "start" => ['required'],
            // "target" => ['required'],
        ]);
        $laporankegiatan = LaporanKegiatanModels::find($id);
        $laporankegiatan->update($request->except(['_token', 'submit', 'updated_at','id_sub','id','id_tahun']));
            // "id_karyawan" => $request->input('id_karyawan'),
            // "id_proyek" => $request->input('id_proyek'),
            // "id_sub" => $request->input('id_sub'),
            // "deskripsi" => $request->input('deskripsi'),
            //"ruas" => $request->input('ruas'),
            // "start" =>  $request->input('start'),
            // "target" =>  $request->input('target')
        //]);
        return redirect('laporankegiatan');
    }
    
    public function destroy($id)
    {
        $hapus= LaporanKegiatanModels::findorfail($id);

        $file = public_path('dokumen/').$hapus->dokumentasi;
        if(file_exists($file)){
            @unlink($file);
        }
        $hapus->delete();
        return redirect('laporankegiatan');
    }

    public function export(){
        $laporankegiatan = LaporanKegiatanModels::join('proyek', 'laporan_kegiatan.id_proyek', '=', 'proyek.id')
            ->join('tahun_anggaran', 'tahun_anggaran.id_tahun', '=', 'proyek.id_tahun')
            ->join('users', 'users.id', '=', 'laporan_kegiatan.id_karyawan')
            ->join('jenis_kegiatan', 'jenis_kegiatan.id_jenis', '=', 'laporan_kegiatan.id_jenis')
            ->join('sub', 'jenis_kegiatan.id_sub', '=', 'sub.id_sub')
            ->join('departemen', 'sub.id', '=', 'departemen.id')
            ->join('approve', 'laporan_kegiatan.id_approve', '=', 'approve.id_approve')
            
            ->get(['laporan_kegiatan.*','users.name','proyek.kode_proyek','proyek.nama_proyek','tahun_anggaran.tahun','jenis_kegiatan.nama_kegiatan','departemen.nama_departemen'
        ,'approve.nama']);    
        // $pdf = PDF::loadView('',[ 'title' => 'Laporan-kegiatan'], compact('laporankegiatan'));
        return view(
            'laporankegiatan.export',
            [
                'title' => 'export-laporankegiatan-page'
            ],
            compact('laporankegiatan')
        );
    }
    public function approve($id){
        
        try {
            LaporanKegiatanModels::where ('id',$id)->update([
                'id_approve' => 2
            ]);
            \Session::flash('sukses' , 'Laporan Kegiatan di setujui');
        } catch (\Throwable $th) {
            \Session::flash('gagal' , $th->getMessage());
        }
        return redirect()->back();
    }

    public function rejected($id){
        
        try {
            LaporanKegiatanModels::where ('id',$id)->update([
                'id_approve' => 3
            ]);
            \Session::flash('sukses' , 'Laporan Kegiatan di setujui');
        } catch (\Throwable $th) {
            \Session::flash('gagal' , $th->getMessage());
        }
        return redirect()->back();
    }
    
    public function view($dokumen){
        //dd($dokumen);
        $dokumen= LaporanKegiatanModels::where('laporan_kegiatan.dokumentasi', '=', $dokumen)->get($dokumen);
        
        //dd($dokumen);
        return Response::make(file_get_contents('dokumen/'.$dokumen), 200, [
                       'content-type'=>'application/pdf',
                   ]);
   }
}

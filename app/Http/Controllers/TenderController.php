<?php

namespace App\Http\Controllers;

use App\Models\ProyekModels;
use App\Models\TenderModel;
use App\Models\TenderModels;
use Illuminate\Http\Request;
use App\Models\KaryawanModels;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TenderController extends Controller
{
    public function index()
    {
        $role = Auth::user()->id_level;
        if ($role == 1) {
            $tender = TenderModels::join('users', 'users.id', '=', 'tender.id_karyawan')
            //->join('users', 'users.id', '=', 'tender.id_karyawan')
            ->get(['tender.*','users.name']);  
        }else{
            $user_id = Auth::id();
            $tender = TenderModels::join('users', 'users.id', '=', 'tender.id_karyawan')
            //->join('users', 'users.id', '=', 'laporan_kegiatan.id_karyawan')
            ->where('users.id', '=', $user_id)
            ->get(['tender.*','users.name']);
        }
        
       
        return view(
            'tender.index',
            [
                'title' => 'tender-page'
            ],
            compact('tender')
        );
    }

    public function tambahtender()
        {
            
            
            $karyawan = KaryawanModels::all();
            return view(
                'tender.tambahtender',
                [
                    'title' => 'Tambah-Tender-page'
                ],
                compact('karyawan')
            );
        }
        public function store(Request $request)
    {
        //  dd($request);
        $request->validate([
            "id_karyawan" => ['required'],
            "nama_tender" => ['required'],
            "dokumen" => ['required'],
            // "ruas" => ['required'],
            // "dokumen" => ['required'],
            // "start" => ['required'],
            // "target" => ['required'],
        ]);
        // $karyawan = KaryawanModel::find($request);
        $idKaryawan = $request->get('id_karyawan');
        $karyawan = KaryawanModels::find($idKaryawan);
        // dd($karyawan->name);
        
        
        if ($request->hasFile('dokumen')) {
            $dokumen = $request->file('dokumen');
            $nama_dokumen = 'AEC Tender' . $karyawan->name . '.' . $dokumen->getClientOriginalExtension();
            $dokumen->move('dokumentender/', $nama_dokumen);
    
            TenderModels::create($request->except(['_token', 'submit', 'updated_at', 'created_at', 'dokumen']) + ['dokumen' => $nama_dokumen]);
    
            return redirect('tender')->with('success', 'File uploaded successfully!');
        }
    
        return redirect('tender')->with('error', 'No file selected.');
    }

    //update
    public function ubah($id)
    {
        // $laporankegiatan = LaporanKegiatanModels::find($id);
        //$proyek = ProyekModels::all();
        
        $tender = TenderModels::join('users', 'users.id', '=', 'tender.id_karyawan')
        //->join('users', 'users.id', '=', 'laporan_kegiatan.id_karyawan')
        ->where('tender.id', '=', $id)
        ->get(['tender.*','users.name']);
        // dd($laporankegiatan);
        return view(
            'tender.ubah',
            [
                'title' => 'ubah-tender-page'
            ],
            compact('tender')
        );
    }

    public function update($id,Request $request)
    {
        $request->validate([
            "id_karyawan" => ['required'],
            "nama_tender" => ['required'],
            //"id_proyek" => ['required'],
            //"ruas" => ['required','not_regex'],
           // "start" => ['required'],
            //"target" => ['required'],
        ]);
        $tender = TenderModels::find($id);
        $tender->update([
            "id_karyawan" => $request->input('id_karyawan'),
            "nama_tender" => $request->input('nama_tender'),
            //"id_proyek" => $request->input('id_proyek'),
           // "ruas" => $request->input('ruas'),
            //"start" =>  $request->input('start'),
           // "target" =>  $request->input('target')
        ]);
        return redirect('tender');
    }
    public function destroy($id)
    {
        $hapus= TenderModels::findorfail($id);

        $file = public_path('dokumentender/').$hapus->dokumen;
        if(file_exists($file)){
            @unlink($file);
        }
        $hapus->delete();
        return redirect('tender');
    }
}

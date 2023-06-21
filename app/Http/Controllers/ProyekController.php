<?php

namespace App\Http\Controllers;

use App\Models\ProyekModels;
use App\Models\TahunanggaranModels;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ProyekController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->id_level == 2) {
                return abort(403, 'Access denied. Your ip is detected');
            }

            return $next($request);
        });
    }
    

    public function index()
    {
        $proyek = ProyekModels::join('tahun_anggaran','tahun_anggaran.id_tahun', '=', 'proyek.id_tahun')
        ->get(['proyek.*','tahun_anggaran.tahun']);
        return view(
            'proyek.index',
            [
                'title' => 'proyek-page'
            ],
            compact('proyek')
        );
    }

        // insert
        public function tambahproyek()
        {
            $tahunanggaran = TahunanggaranModels::all();
            $proyek = ProyekModels::all();
            return view(
                'proyek.tambahproyek',
                [
                    'title' => 'tambah-proyek-page'
                ],
                compact('tahunanggaran','proyek')
            );
        }

        public function store(Request $request)
        {
            //dd($request);
            $request->validate([
                "kode_proyek" => ['required'],
                "nama_proyek" => ['required'],
                "id_tahun" => ['required'],
                "start" => ['required'],
                "target" => ['required'],
                //"id_approve" => ['required'],
                // "start" => ['required'],
                // "target" => ['required'],
            ]);
            ProyekModels::create($request->except(['_token','submit','updated_at',
            'created_at']));
            return redirect('proyek');
        }
        //update
    public function ubah($id)
    {
        $proyek = ProyekModels::find($id);
        $tahunanggaran = TahunanggaranModels::all();
        // dd($proyek);
        return view(
            'proyek.ubah',
            [
                'title' => 'ubah-proyek-page'
            ],
            compact('proyek','tahunanggaran')
        );
    }

   
    public function update($id,Request $request)
    {
        $proyek = ProyekModels::find($id);
        $proyek->update([
            'kode_proyek' => $request->input('kode_proyek'),
            'nama_proyek' => $request->input('nama_proyek'),
            'id_tahun' => $request->input('id_tahun'),
            'start' => $request->input('start'),
            'target' => $request->input('target')
        ]);
        return redirect('proyek');
    }
    
    public function destroy($id)
    {
        $proyek = ProyekModels::find($id);
        $proyek->delete();
        return redirect('proyek');
    }
    public function get_proyek(Request $request)
    {
        $array_input = $request->post();
        
        $id_tahun = $array_input['id_tahun'];

        $proyek = ProyekModels::where('id_tahun', $id_tahun)->get();

        $response = new \stdClass;
        $response->data = $proyek;

        die(json_encode($response));
    }
    

}

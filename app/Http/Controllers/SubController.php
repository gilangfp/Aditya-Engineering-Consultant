<?php

namespace App\Http\Controllers;

use App\Models\SubModels;
use Illuminate\Http\Request;
use App\Models\DepartemenModels;
use Illuminate\Routing\Controller;

class SubController extends Controller
{
    public function index()
    {
        $sub = SubModels::join('departemen','departemen.id', '=', 'sub.id')
        ->get(['sub.*','departemen.nama_departemen']);
        return view(
            'sub.index',
            [
                'title' => 'sub-page'
            ],
            compact('sub')
        );
    }

    public function tambahsub()
        {
            $sub = SubModels::all();
            $departemen = DepartemenModels::all();
            return view(
                'sub.tambahsub',
                [
                    'title' => 'tambah-sub-page'
                ],
                compact('sub','departemen')
            );
        }
        public function store(Request $request)
        {
            //dd($request);
            $request->validate([
                "id" => ['required'],
                "nama_sub" => ['required'],
                //"id_tahun" => ['required'],
                //"start" => ['required'],
                //"target" => ['required'],
                //"id_approve" => ['required'],
                // "start" => ['required'],
                // "target" => ['required'],
            ]);
            SubModels::create($request->except(['_token','submit','updated_at',
            'created_at']));
            return redirect('sub');
        }
        
        public function ubah($id_sub)
    {
        $sub = SubModels::all();
        $departemen = DepartemenModels::all();
        $sub = SubModels::join('departemen', 'departemen.id', '=', 'sub.id')
        ->where('sub.id_sub', '=', $id_sub)
        ->get(['sub.*','departemen.nama_departemen']); 
        //dd($id_sub);
        return view(
            'sub.ubah',
            [
                'title' => 'ubah-sub-page'
            ],
            compact('sub','departemen')
        );
    }

    public function update($id_sub,Request $request)
    {
         //dd($request);
         $request->validate([
            "id" => ['required'],
            "nama_sub" => ['required'],
            
        ]);
        //dd($request);
        $sub = SubModels::where ('id_sub',$id_sub)->update([
            "id" => $request->input('id'),
            "nama_sub" => $request->input('nama_sub')
        ]);
        
        return redirect('sub');
    }
    public function destroy($id_sub)
    {
        //dd($id_jenis);
        $sub = SubModels::where ('id_sub',$id_sub)->delete();
        //$jenis_kegiatan->delete();
        return redirect('sub');
    }
}

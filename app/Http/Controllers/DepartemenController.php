<?php

namespace App\Http\Controllers;

use App\Models\ProyekModels;
use Illuminate\Http\Request;
use App\Models\DepartemenModels;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DepartemenController extends Controller
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
        $departemen = DepartemenModels::all();
        return view(
            'departemen.index',
            [
                'title' => 'departemen-page'
            ],
            compact('departemen')
        );
    }

    public function tambahdepartemen()
    {
        
        
        $departemen = DepartemenModels::all();
        return view(
            'departemen.tambahdepartemen',
            [
                'title' => 'Tambah-Departemen-page'
            ],
            compact('departemen')
        );
    }
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            "nama_departemen" => ['required'],
            // "nama_proyek" => ['required'],
            // "id_tahun" => ['required'],
            // "start" => ['required'],
            // "target" => ['required'],
            //"id_approve" => ['required'],
            // "start" => ['required'],
            // "target" => ['required'],
        ]);
        DepartemenModels::create($request->except(['_token','submit','updated_at',
        'created_at']));
        return redirect('departemen');
    }
    public function ubah($id)
    {
        $departemen = DepartemenModels::find($id);
        // dd($proyek);
        return view(
            'departemen.ubah',
            [
                'title' => 'ubah-departemen-page'
            ],
            compact('departemen')
        );
    }

    public function update($id,Request $request)
    {
        $departemen = DepartemenModels::find($id);
        $departemen->update([
            'nama_departemen' => $request->input('nama_departemen')
        ]);
        return redirect('departemen');
    }

    public function destroy($id)
    {
        $departemen = DepartemenModels::find($id);
        $departemen->delete();
        return redirect('departemen');
    }
}

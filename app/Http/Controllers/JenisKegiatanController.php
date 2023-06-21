<?php

namespace App\Http\Controllers;

use App\Models\SubModels;
use Illuminate\Http\Request;
use App\Models\DepartemenModels;

use Illuminate\Routing\Controller;
use App\Models\JeniskegiatanModels;
use Illuminate\Support\Facades\Auth;

class JenisKegiatanController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         if (Auth::check() && Auth::user()->id_level == 2) {
    //             return abort(403, 'Access denied. Your ip is detected');
    //         }

    //         return $next($request);
    //     });
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user()->id_level;
        if ($role == 1) {
            $jenis_kegiatan = JeniskegiatanModels::join('sub', 'jenis_kegiatan.id_sub', '=', 'sub.id_sub')
            ->join('departemen', 'sub.id', '=', 'departemen.id')
            ->get(['jenis_kegiatan.*','departemen.nama_departemen','sub.nama_sub']);  
        }else{
            $user_id = Auth::id();
            $jenis_kegiatan = JeniskegiatanModels::join('sub', 'jenis_kegiatan.id_sub', '=', 'sub.id_sub')
            ->join('departemen', 'sub.id', '=', 'departemen.id')
            ->get(['jenis_kegiatan.*','departemen.nama_departemen','sub.nama_sub']);
        }

        return view(
            'jenis.index',
            [
                'title' => 'Jenis-kegiatan'
            ],
            compact('jenis_kegiatan')
        );
        }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambahjenis()
    {
        $sub = SubModels::all();
        $departemen = DepartemenModels::all();
        $jenis_kegiatan = JeniskegiatanModels::all();
        return view(
            'jenis.tambahjenis',
            [
                'title' => 'Tambah-Jenis-page'
            ],
            compact('sub','departemen','jenis_kegiatan')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        JeniskegiatanModels::create($request->except(['_token','submit','updated_at',
        'created_at','id']));
        return redirect('jenis');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ubah($id_jenis)
    {
        $sub = SubModels::all();
        $departemen = DepartemenModels::all();
        $jenis_kegiatan = JeniskegiatanModels::all();
        $jenis_kegiatan = JeniskegiatanModels::join('sub', 'jenis_kegiatan.id_sub', '=', 'sub.id_sub')
        ->join('departemen', 'sub.id', '=', 'departemen.id')
        ->where('jenis_kegiatan.id_jenis', '=', $id_jenis)
        ->get(['jenis_kegiatan.*','departemen.nama_departemen','sub.nama_sub']); 
        //dd($jenis_kegiatan);
        return view(
            'jenis.ubah',
            [
                'title' => 'ubah-jenis-page'
            ],
            compact('sub','departemen','jenis_kegiatan')
        );
    }
    public function update($id_jenis,Request $request)
    {
         //dd($request);
         $request->validate([
            "id_sub" => ['required'],
            "nama_kegiatan" => ['required'],
            // "id_sub" => ['required'],
            // "deskripsi" => ['required'],
            // "start" => ['required'],
            // "target" => ['required'],
        ]);
        //dd($request);
        $jenis_kegiatan = JeniskegiatanModels::where ('id_jenis',$id_jenis)->update([
            "id_sub" => $request->input('id_sub'),
            "nama_kegiatan" => $request->input('nama_kegiatan')
        ]);
        // $jenis_kegiatan = JeniskegiatanModels::where($id_jenis);
        // $jenis_kegiatan->update($request->except(['_token', 'submit', 'updated_at','id']));
            // "id_karyawan" => $request->input('id_karyawan'),
            // "id_proyek" => $request->input('id_proyek'),
            // "id_sub" => $request->input('id_sub'),
            // "deskripsi" => $request->input('deskripsi'),
            //"ruas" => $request->input('ruas'),
            // "start" =>  $request->input('start'),
            // "target" =>  $request->input('target')
        //]);
        return redirect('jenis');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_jenis)
    {
        //dd($id_jenis);
        $jenis_kegiatan = JeniskegiatanModels::where ('id_jenis',$id_jenis)->delete();
        //$jenis_kegiatan->delete();
        return redirect('jenis');
    }

    public function get_sub(Request $request)
    {
        $array_input = $request->post();
        
        $id_department = $array_input['id_department'];

        $sub = SubModels::where('id', $id_department)->get();;

        $response = new \stdClass;
        $response->data = $sub;

        die(json_encode($response));
    }

    
    public function get_jenis_kegiatan(Request $request)
    {
        $array_input = $request->post();
        
        $id_sub = $array_input['id_sub'];

        $jenis_kegiatan = JeniskegiatanModels::where('id_sub', $id_sub)->get();

        $response = new \stdClass;
        $response->data = $jenis_kegiatan;

        die(json_encode($response));
    }
}

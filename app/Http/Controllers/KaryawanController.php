<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KaryawanModels;
use App\Models\LevelModels;
use App\Http\Controllers\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
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
        // dd(Auth::user()->id_level);
        // $karyawan = KaryawanModels::all();
        $karyawan = KaryawanModels::join('level', 'users.id_level', '=', 'level.id')
        ->select('users.*', 'level.nama_level')
        ->get();
        return view(
            'karyawan.index',
            [
                'title' => 'karyawan-page'
            ],
            compact('karyawan')
        );
    }

    // insert
    public function tambahkaryawan()
    {
        $level = LevelModels::all();
        return view(
            'karyawan.tambahkaryawan',
            [
                'title' => 'tambah-karyawan-page'
            ],
             compact('level')
        );
    }

    public function store(Request $request)
    {
    $request->validate([
        'id_level' => ['required'],
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'min:8', 'confirmed']
    ]);
        KaryawanModels::create([
            'id_level' => $request['id_level'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect('karyawan');
    }

    //update
    public function ubah($id)
    {
        $karyawan = KaryawanModels::find($id);
        $level = LevelModels::all();
        return view(
            'karyawan.ubah',
            [
                'title' => 'ubah-karyawan-page'
            ],
            compact('karyawan','level')
        );
    }
   
    public function update($id,Request $request)
    {
        $karyawan = KaryawanModels::find($id);

        $request->validate([
            'id_level' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // $karyawan->update([
        //     'id_level' => $request->input('id_level'),
        //     'name' => $request->input('name'),
        //     'email' => $request->input('email')
        // ]);
        if ($request->filled('password')) {
            $karyawan->update([
                'id_level' => $request->input('id_level'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
        }
        else {
            $karyawan->update([
                'id_level' => $request->input('id_level'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);
        }
        return redirect('karyawan');
    }
    
    public function destroy($id)
    {
        $karyawan = KaryawanModels::find($id);
        $karyawan->delete();
        return redirect('karyawan');
    }

}

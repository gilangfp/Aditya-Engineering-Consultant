<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KaryawanModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function changePassword($id)
    {
       
        if (Auth::user()->id != $id) {
             abort(403, 'Access denied.');
        }
        $karyawan = KaryawanModels::find($id);
        return view('auth.passwords.change_password',
            [
                'title' => 'change-password-page'
            ],
            compact('karyawan'));
    }

      public function update($id,Request $request)
    {
        $karyawan = KaryawanModels::find($id);

        $request->validate([
            'password' => ('nullable'|'string'|'min:8'|'confirmed')
        ]);

        if ($request->filled('password')) {
            $karyawan->update([
                'password' => Hash::make($request->input('password')),
            ]);
        }
        return redirect('home');
    }
    
}
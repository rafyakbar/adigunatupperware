<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function tampilUbahProfil()
    {
        return view('ubahprofil');
    }

    public function ubahProfil(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'nohp' => 'required|number',
            'email' => 'required'
        ]);

        Auth::user()->update([
            'name' => $request->nama,
            'nohp' => $request->nohp,
            'email' => $request->email
        ]);

        return back()->with('message', 'Profil berhasil diganti!');
    }

    public function ubahPassword(Request $request)
    {
        $this->validate($request, [
            'password_lama' => 'required|min:6',
            'password_baru' => 'required|min:6',
            'konfirmasi_password_baru' => 'required|min:6'
        ]);

        if (Hash::check($request->password_lama, Auth::user()->password)){
            if ($request->password_baru == $request->konfirmasi_password_baru){
                Auth::user()->update([
                    'password' => bcrypt($request->password_baru)
                ]);
            }
            else{
                return back()->with('message', 'Konfirmasi password salah!');
            }
        }
        else{
            return back()->with('message', 'Password lama salah!');
        }

        return back()->with('message', 'Password berhasil diganti');
    }
}

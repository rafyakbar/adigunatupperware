<?php

namespace App\Http\Controllers;

use App\Monitoring;
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

    public function tampilPegawai(Request $request)
    {
        $request->perhalaman = ($request->perhalaman < 10) ? 10 : $request->perhalaman;

        return view('pegawai', [
            'pegawai' => User::where('hak_akses', 'pegawai')->orderBy('name')->paginate($request->perhalaman),
            'no' => 0,
            'perhalaman' => $request->perhalaman
        ]);
    }

    public function ubahProfil(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'nohp' => 'required|numeric',
            'email' => 'required'
        ]);

        $nama = Auth::user()->name;
        $nohp = Auth::user()->nohp;
        $email = Auth::user()->email;
        Auth::user()->update([
            'name' => $request->nama,
            'nohp' => $request->nohp,
            'email' => $request->email
        ]);
        Monitoring::create([
            'user_id' => Auth::user()->id,
            'menu' => 'profil',
            'keterangan' => Auth::user()->name.' mengubah (nama : '.$nama.', nohp : '.$nohp.' dan email : '.$email.') menjadi (nama : '.Auth::user()->name.', nohp : '.Auth::user()->nohp.' dan email : '.Auth::user()->email.')'
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
        Monitoring::create([
            'user_id' => Auth::user()->id,
            'menu' => 'profil',
            'keterangan' => Auth::user()->name.' mengubah password (<b>'.$request->password_lama.'</b>) menjadi (<b>'.$request->password_baru.'</b>)'
        ]);

        return back()->with('message', 'Password berhasil diganti');
    }

    public function tambahPegawai(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'nohp' => 'required|numeric',
            'password' => 'required'
        ]);

        $pegawai = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'password' => bcrypt($request->password),
            'hak_akses' => 'pegawai'
        ]);

        return back()->with('message', 'Berhasil menambahkan '.$pegawai->name.' sebagai pegawai!');
    }

    public function hapusPegawai(Request $request)
    {
        $pegawai = User::find($request->id);
        $nama = $pegawai->name;
        $pegawai->delete();

        return back()->with('message', 'Berhasil menghapus '.$nama.' dari pegawai!');
    }
}

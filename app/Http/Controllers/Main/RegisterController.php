<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\PendaftaranRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Image;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // dd($request->all());
        try {
            $user = [
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ];

            if($request->hasFile('foto')) {
                $filenamewithextension = $request->file('foto')->getClientOriginalName();
                $extension = $request->file('foto')->getClientOriginalExtension();

                $filenametostore = str_replace(' ', '', $request->nama) . '-' . time() . '.' . $extension;
                $save_path = 'assets/uploads/users/';

                if (!file_exists($save_path)) {
                    mkdir($save_path, 666, true);
                }

                $user['foto'] = $save_path . $filenametostore;
            }

            $img = Image::make($request->file('foto')->getRealPath());
            $img->resize(300, 300);
            $img->save($save_path . $filenametostore);

            // save user
            User::create($user);
            
            return redirect()->route('login')->with([
                'message' => 'Pendaftaran berhasil',
                'status' => 'success',
            ]);

            // return redirect()->back()->with([
            //     'message' => 'Pendaftaran berhasil',
            //     'status' => 'success',
            // ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Pendaftaran gagal',
                // 'message' => $e->getMessage(),
                'status' => 'error',
            ]);
        }
    }
}

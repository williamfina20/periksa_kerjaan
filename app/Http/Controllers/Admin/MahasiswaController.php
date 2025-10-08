<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $id_pengguna = '';
        if ($request->id_pengguna != '') {
            $mahasiswa = Mahasiswa::where('users_id', $request->id_pengguna)->get();
            $id_pengguna = $request->id_pengguna;
        } else {
            $mahasiswa = Mahasiswa::all();
        }
        $pengguna = User::all();
        return view('admin.mahasiswa.index', [
            'mahasiswa' => $mahasiswa,
            'pengguna' => $pengguna,
            'id_pengguna' => $id_pengguna,
        ]);
    }
}

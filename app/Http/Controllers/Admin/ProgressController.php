<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Progress;
use App\Models\User;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index(Request $request)
    {
        $id_pengguna = '';
        if ($request->id_pengguna != '') {
            $progress = Progress::where('users_id', $request->id_pengguna)->latest()->get();
            $id_pengguna = $request->id_pengguna;
        } else {
            $progress = Progress::latest()->get();
        }
        $pengguna = User::all();
        return view('admin.progress.index', [
            'progress' => $progress,
            'pengguna' => $pengguna,
            'id_pengguna' => $id_pengguna,
        ]);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\List_Data_Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where('users_id', Auth::user()->id)->get();
        return view('user.mahasiswa.index', [
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function create()
    {
        $kab_kota = List_Data_Controller::list_kab_kota();
        return view('user.mahasiswa.create', [
            'kab_kota' => $kab_kota
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nac' => 'required|unique:mahasiswas,nac',
            'no_hp' => 'required',
            'kab_kota' => 'required',
            'sistem_paket' => 'required',
        ]);

        Mahasiswa::create([
            'nama' => $request->nama,
            'nac' => $request->nac,
            'no_hp' => $request->no_hp,
            'kab_kota' => $request->kab_kota,
            'sistem_paket' => $request->sistem_paket,
            'users_id' => Auth::user()->id,
        ]);

        toastr()->success('Data berhasil ditambahkan', [
            'position' => 'bottom-right'
        ]);

        return redirect()->route('user.mahasiswa');
    }

    public function edit($id)
    {
        $kab_kota = List_Data_Controller::list_kab_kota();
        $mahasiswa = Mahasiswa::find($id);

        return view('user.mahasiswa.edit', [
            'kab_kota' => $kab_kota,
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nac' => 'required|unique:mahasiswas,nac,' . $id,
            'no_hp' => 'required',
            'kab_kota' => 'required',
            'sistem_paket' => 'required',
        ]);

        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->update($request->all());

        toastr()->success('Data berhasil diupdate', [
            'position' => 'bottom-right'
        ]);

        return redirect()->route('user.mahasiswa');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();

        toastr()->success('Data berhasil dihapus', [
            'position' => 'bottom-right'
        ]);

        return redirect()->route('user.mahasiswa');
    }
}

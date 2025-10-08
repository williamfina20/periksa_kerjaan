<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\List_Data_Controller;
use App\Http\Requests\PenggunaStoreRequest;
use App\Http\Requests\PenggunaUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = User::all();
        return view('admin.pengguna.index', [
            'pengguna' => $pengguna
        ]);
    }

    public function create()
    {
        $kab_kota = List_Data_Controller::list_kab_kota();
        return view('admin.pengguna.create', [
            'kab_kota' => $kab_kota
        ]);
    }

    public function store(PenggunaStoreRequest $request)
    {
        $validasiData = $request->validated();
        $create_pengguna = User::create($validasiData);
        $create_pengguna->assignRole('user');

        toastr()->success('Data Berhasil ditambahkan', [
            'position' => 'bottom-right',
        ]);
        return redirect()->route('admin.pengguna');
    }

    public function edit($id)
    {
        $kab_kota = List_Data_Controller::list_kab_kota();
        $pengguna = User::find($id);

        return view('admin.pengguna.edit', [
            'kab_kota' => $kab_kota,
            'pengguna' => $pengguna,
        ]);
    }

    public function update(PenggunaUpdateRequest $request, $id)
    {

        $validasiData = $request->validated();
        $pengguna = User::find($id);

        $pengguna->update($validasiData);

        toastr()->success('Data Berhasil diupdate', [
            'position' => 'bottom-right',
        ]);
        return redirect()->route('admin.pengguna');
    }

    public function destroy($id)
    {
        $pengguna = User::find($id);
        $pengguna->removeRole('user');
        $pengguna->delete();

        toastr()->success('Data Berhasil dihapus', [
            'position' => 'bottom-right',
        ]);
        return redirect()->route('admin.pengguna');
    }
}

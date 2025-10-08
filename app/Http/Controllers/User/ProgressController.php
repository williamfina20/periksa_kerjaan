<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\List_Data_Controller;
use App\Models\Mahasiswa;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgressController extends Controller
{
    public function index()
    {
        $progress = Progress::where('users_id', Auth::user()->id)->latest()->get();
        return view('user.progress.index', [
            'progress' => $progress
        ]);
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::where('users_id', Auth::user()->id)->get();
        $proses = List_Data_Controller::list_proses();
        return view('user.progress.create', [
            'mahasiswa' => $mahasiswa,
            'proses' => $proses
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa' => 'required',
            'proses' => 'required',
            'data_pendukung' => 'required|max:4096',
            'keterangan' => 'required',
        ]);

        $slug = Str::of($request->proses)->snake();

        if ($request->file('data_pendukung')) {
            $nama_file = $request->mahasiswa . '_' . date('d_m_y__H_i_s') . '_' . $slug . '.' . $request->data_pendukung->extension();
            $path = $request->file('data_pendukung')->storeAs('data_pendukung', $nama_file);
        } else {
            $path = '';
        }

        Progress::create([
            'mahasiswas_id' => $request->mahasiswa,
            'proses' => $request->proses,
            'data_pendukung' => $path,
            'keterangan' => $request->keterangan,
            'users_id' => Auth::user()->id
        ]);

        toastr()->success('Data berhasil ditambahkan', [
            'position' => 'bottom-right'
        ]);

        return redirect()->route('user.progress');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::where('users_id', Auth::user()->id)->get();
        $progress = Progress::find($id);
        $proses = List_Data_Controller::list_proses();
        return view('user.progress.edit', [
            'mahasiswa' => $mahasiswa,
            'progress' => $progress,
            'proses' => $proses
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mahasiswa' => 'required',
            'proses' => 'required',
            'keterangan' => 'required',
        ]);

        $slug = Str::of($request->proses)->snake();
        $progress = Progress::find($id);


        if ($request->file('data_pendukung')) {
            Storage::delete($progress->data_pendukung);
            $nama_file = $request->mahasiswa . '_' . date('d_m_y__H_i_s') . '_' . $slug . '.' . $request->data_pendukung->extension();
            $path = $request->file('data_pendukung')->storeAs('data_pendukung', $nama_file);

            $progress->update([
                'mahasiswas_id' => $request->mahasiswa,
                'proses' => $request->proses,
                'data_pendukung' => $path,
                'keterangan' => $request->keterangan,
            ]);
        } else {
            $progress->update([
                'mahasiswas_id' => $request->mahasiswa,
                'proses' => $request->proses,
                'keterangan' => $request->keterangan,
            ]);
        }

        toastr()->success('Data berhasil diupdate', [
            'position' => 'bottom-right'
        ]);

        return redirect()->route('user.progress');
    }

    public function destroy($id)
    {
        $progress = Progress::find($id);
        Storage::delete($progress->data_pendukung);
        $progress->delete();

        toastr()->success('Data berhasil dihapus', [
            'position' => 'bottom-right'
        ]);

        return redirect()->route('user.progress');
    }
}

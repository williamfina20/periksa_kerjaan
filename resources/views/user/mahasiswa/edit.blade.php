@extends('user.layouts.app')

@section('content')
    <div class="container mx-auto px-1">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('user.beranda') }}">Beranda</a></li>
                <li><a href="{{ route('user.mahasiswa') }}">Mahasiswa</a></li>
                <li>Edit Mahasiswa</li>
            </ul>
        </div>
        <div>
            <div class="card card-border bg-base-100 w-full shadow">
                <div class="card-body">
                    <h2 class="card-title">Edit Mahasiswa</h2>
                    <form action="{{ route('user.mahasiswa.update', $mahasiswa->id) }}" method="post">
                        @csrf
                        @method('put')
                        <fieldset class="fieldset mb-2">
                            <legend class="fieldset-legend">Nama</legend>
                            <input type="text" name="nama" class="input w-full" placeholder="Type here"
                                value="{{ $mahasiswa->nama }}" />
                            @error('nama')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <fieldset class="fieldset mb-2">
                            <legend class="fieldset-legend">NAC</legend>
                            <input type="text" name="nac" class="input w-full" placeholder="Type here"
                                value="{{ $mahasiswa->nac }}" />
                            @error('nac')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <fieldset class="fieldset mb-2">
                            <legend class="fieldset-legend">No Hp</legend>
                            <input type="number" name="no_hp" class="input w-full" placeholder="Type here"
                                value="{{ $mahasiswa->no_hp }}" />
                            @error('no_hp')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <fieldset class="fieldset mb-2">
                            <legend class="fieldset-legend">Kab/Kota</legend>
                            <select class="select w-full" name="kab_kota">
                                @foreach ($kab_kota as $item)
                                    <option value="{{ $item }}" @if ($item == $mahasiswa->kab_kota) selected @endif>
                                        {{ $item }}</option>
                                @endforeach
                            </select>
                            @error('kab_kota')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <fieldset class="fieldset mb-2">
                            <legend class="fieldset-legend">Sistem Paket</legend>
                            <select class="select w-full" name="sistem_paket">
                                <option value="Sipas" @if ($mahasiswa->sistem_paket == 'Sipas') selected @endif>Sipas</option>
                                <option value="Non-Sipas" @if ($mahasiswa->sistem_paket == 'Non-Sipas') selected @endif>Non-Sipas
                                </option>
                            </select>
                            @error('sistem_paket')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <div class="mb-2 flex justify-end">
                            <a href="{{ route('user.mahasiswa') }}" class="btn btn-secondary me-1">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

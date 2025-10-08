@extends('user.layouts.app')

@section('content')
    <div class="container mx-auto px-1">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('user.beranda') }}">Beranda</a></li>
                <li><a href="{{ route('user.mahasiswa') }}">Mahasiswa</a></li>
                <li>Tambah Mahasiswa</li>
            </ul>
        </div>
        <div>
            <div class="card card-border bg-base-100 w-full shadow">
                <div class="card-body">
                    <h2 class="card-title">Tambah Mahasiswa</h2>
                    <form action="{{ route('user.mahasiswa.store') }}" method="post">
                        @csrf
                        <fieldset class="fieldset mb-2">
                            <legend class="fieldset-legend">Nama</legend>
                            <input type="text" name="nama" class="input w-full" placeholder="Type here"
                                value="{{ old('nama') }}" />
                            @error('nama')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <fieldset class="fieldset mb-2">
                            <legend class="fieldset-legend">NAC</legend>
                            <input type="text" name="nac" class="input w-full" placeholder="Type here"
                                value="{{ old('nac') }}" />
                            @error('nac')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <fieldset class="fieldset mb-2">
                            <legend class="fieldset-legend">No Hp</legend>
                            <input type="number" name="no_hp" class="input w-full" placeholder="Type here"
                                value="{{ old('no_hp') }}" />
                            @error('no_hp')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <fieldset class="fieldset mb-2">
                            <legend class="fieldset-legend">Kab/Kota</legend>
                            <select class="select w-full" name="kab_kota">
                                <option disabled selected>-- Pilih --</option>
                                @foreach ($kab_kota as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('kab_kota')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <fieldset class="fieldset mb-2">
                            <legend class="fieldset-legend">Sistem Paket</legend>
                            <select class="select w-full" name="sistem_paket">
                                <option disabled selected>-- Pilih --</option>
                                <option value="Sipas">Sipas</option>
                                <option value="Non-Sipas">Non-Sipas</option>
                            </select>
                            @error('sistem_paket')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <div class="mb-2 flex justify-end">
                            <a href="{{ route('user.mahasiswa') }}" class="btn btn-secondary me-1">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

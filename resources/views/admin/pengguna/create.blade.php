@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-1">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.beranda') }}">Beranda</a></li>
                <li><a href="{{ route('admin.pengguna') }}">Pengguna</a></li>
                <li>Tambah Pengguna</li>
            </ul>
        </div>
        <div>
            <div class="card card-border bg-base-100 w-full shadow">
                <div class="card-body">
                    <h2 class="card-title">Tambah Pengguna</h2>
                    <form action="{{ route('admin.pengguna') }}" method="post">
                        @csrf
                        <fieldset class="fieldset mb-2">
                            <legend class="fieldset-legend">Name</legend>
                            <input type="text" name="name" class="input w-full" placeholder="Type here"
                                value="{{ old('name') }}" />
                            @error('name')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <fieldset class="fieldset mb-2">
                            <legend class="fieldset-legend">Email</legend>
                            <input type="email" name="email" class="input w-full" placeholder="Type here"
                                value="{{ old('email') }}" />
                            @error('email')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <fieldset class="fieldset mb-2">
                            <legend class="fieldset-legend">Password</legend>
                            <input type="password" name="password" class="input w-full" placeholder="Type here" />
                            @error('password')
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
                            <legend class="fieldset-legend">No Hp</legend>
                            <input type="number" name="no_hp" class="input w-full" id="summernote"
                                placeholder="Type here" value="{{ old('no_hp') }}" />
                            @error('no_hp')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <div class="mb-2 flex justify-end">
                            <a href="{{ route('admin.pengguna') }}" class="btn btn-secondary me-1">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                    <div id="summernote"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

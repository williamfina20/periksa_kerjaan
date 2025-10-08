@extends('user.layouts.app')

@section('content')
    <div class="container mx-auto px-1">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('user.beranda') }}">Beranda</a></li>
                <li><a href="{{ route('user.progress') }}">Progress</a></li>
                <li>Edit Progress</li>
            </ul>
        </div>
        <div>
            <div class="card card-border bg-base-100 w-full shadow">
                <div class="card-body">
                    <h2 class="card-title">Edit Progress</h2>
                    <form action="{{ route('user.progress.update', $progress->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <fieldset class="fieldset mb-2">
                            <legend class="fieldset-legend">Mahasiswa</legend>
                            <select class="select w-full" name="mahasiswa" required>
                                <option disabled selected>-- Pilih --</option>
                                @foreach ($mahasiswa as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $progress->mahasiswas_id ? 'selected' : '' }}>{{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mahasiswa')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <fieldset class="fieldset mb-2">
                            <legend class="fieldset-legend">Proses</legend>
                            <select class="select w-full" name="proses" required>
                                @foreach ($proses as $item)
                                    <option value="{{ $item }}" {{ $item == $progress->proses ? 'selected' : '' }}>
                                        {{ $item }}</option>
                                @endforeach
                            </select>
                            @error('proses')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <fieldset class="fieldset mb-2">
                            <legend class="fieldset-legend">Data Pendukung (foto,Screenshoot, dokumen)</legend>
                            <input type="file" name="data_pendukung" class="file-input w-full" placeholder="Type here" />
                            <div>
                                <a href="{{ asset('storage/' . $progress->data_pendukung) }}"
                                    class="btn btn-link">Lihat</a>
                                *Kosongkan jika tidak ingin diganti
                            </div>
                            @error('data_pendukung')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <fieldset class="fieldset mb-2">
                            <legend class="fieldset-legend">Keterangan</legend>
                            <textarea class="textarea w-full" name="keterangan">{{ $progress->keterangan }}</textarea>
                            @error('keterangan')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <div class="mb-2 flex justify-end">
                            <a href="{{ route('user.progress') }}" class="btn btn-secondary me-1">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-1">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.beranda') }}">Beranda</a></li>
                <li>Progress</li>
            </ul>
        </div>
        <div>
            <div class="card card-border bg-base-100 w-full shadow">
                <div class="card-body">
                    <div class="flex justify-between">
                        <h2 class="card-title">Progress</h2>
                        <form action="{{ route('admin.progress') }}" method="get">
                            <div class="flex">
                                <select class="select" name="id_pengguna" onchange="this.form.submit()">
                                    <option value="" {{ $id_pengguna ? '' : 'selected' }}>Semua</option>
                                    @foreach ($pengguna as $item)
                                        @if ($item->hasRole('user'))
                                            <option value="{{ $item->id }}"
                                                {{ $id_pengguna == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="overflow-x-auto rounded-md border border-base-content/5 bg-base-100 p-2">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mahasiswa</th>
                                    <th>Proses</th>
                                    <th>Data Pendukung</th>
                                    <th>Keterangan</th>
                                    <th>Waktu</th>
                                    <th>PJW</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($progress as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->mahasiswa ? $item->mahasiswa->nama : '' }}</td>
                                        <td>{{ $item->proses }}</td>
                                        <td><a href="{{ asset('storage/' . $item->data_pendukung) }}"
                                                class="btn btn-link">Lihat</a></td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ date('d/M/Y H:i:s', strtotime($item->created_at)) }}</td>
                                        <td>
                                            {{ $item->users ? $item->users->name : '' }}
                                        </td>
                                        <td>
                                            aksi
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

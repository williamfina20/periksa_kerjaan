@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-1">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.beranda') }}">Beranda</a></li>
                <li>Mahasiswa</li>
            </ul>
        </div>
        <div>
            <div class="card card-border bg-base-100 w-full shadow">
                <div class="card-body">
                    <div class="flex justify-between">
                        <h2 class="card-title">Mahasiswa</h2>
                        <form action="{{ route('admin.mahasiswa') }}" method="get">
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
                                    <th>Nama</th>
                                    <th>NAC</th>
                                    <th>No. Hp</th>
                                    <th>Kab/Kota</th>
                                    <th>Sistem paket</th>
                                    <th>PJW</th>
                                    <th>Progress</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->nac }}</td>
                                        <td>{{ $item->no_hp }}</td>
                                        <td>{{ $item->kab_kota }}</td>
                                        <td>{{ $item->sistem_paket }}</td>
                                        <td>{{ $item->users ? $item->users->name : '' }}</td>
                                        <td>
                                            @if ($item->progress_terakhir)
                                                <h7 class="bg-gray-500 py-1 px-2 rounded-full text-white">
                                                    {{ $item->progress_terakhir->proses }}
                                                </h7>
                                            @endif
                                        </td>
                                        <td>aksi</td>
                                        {{-- <td>
                                            <form action="{{ route('admin.pengguna.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('admin.pengguna.edit', $item->id) }}"
                                                    class="btn btn-info btn-sm text-white">Edit
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                                    </svg>
                                                </a>
                                                <button class="btn btn-error btn-sm text-white" type="submit"
                                                    onclick="return confirm(`yakin ingin menghapus akun {{ $item->name }}?`)">Hapus<svg
                                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                        <path
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                    </svg></button>
                                            </form>
                                        </td> --}}
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

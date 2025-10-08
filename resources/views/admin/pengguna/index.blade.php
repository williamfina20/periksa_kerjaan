@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-1">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.beranda') }}">Beranda</a></li>
                <li>Pengguna</li>
            </ul>
        </div>
        <div>
            <div class="card card-border bg-base-100 w-full shadow">
                <div class="card-body">
                    <div class="flex justify-between">
                        <h2 class="card-title">Pengguna</h2>

                        <a href="{{ route('admin.pengguna.create') }}" class="btn btn-primary">Tambah
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                            </svg>
                        </a>
                    </div>
                    <div class="overflow-x-auto rounded-md border border-base-content/5 bg-base-100 p-2">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Nama</th>
                                    <th>Kab/Kota</th>
                                    <th>No Hp</th>
                                    <th>Status Hari ini</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($pengguna as $item)
                                    @if ($item->hasRole('user'))
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>

                                                {{ $item->name }}
                                            </td>
                                            <td>{{ $item->kab_kota }}</td>
                                            <td>{{ $item->no_hp }}</td>
                                            <td>
                                                @if ($item->cek_progress_hari_ini($item->id) > 0)
                                                    <div class="status status-success"></div> sudah input
                                                @else
                                                    <div class="inline-grid *:[grid-area:1/1]">
                                                        <div class="status status-error animate-ping"></div>
                                                        <div class="status status-error"></div>
                                                    </div> Belum input
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.pengguna.destroy', $item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('admin.pengguna.edit', $item->id) }}"
                                                        class="btn btn-info btn-sm text-white">Edit
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-pencil"
                                                            viewBox="0 0 16 16">
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
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

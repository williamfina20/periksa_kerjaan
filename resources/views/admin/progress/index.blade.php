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
                                        <td>{{ date('d/M/Y H:i:s', strtotime($item->created_at)) }}</td>
                                        <td>
                                            {{ $item->users ? $item->users->name : '' }}
                                        </td>
                                        <td>
                                            <a href="{{ asset('storage/' . $item->data_pendukung) }}"
                                                class="btn btn-sm btn-secondary">Data Pendukung</a>
                                            <button class="btn btn-sm"
                                                onclick="{my_modal_1.showModal(),tampil_data(`{{ $item->mahasiswa ? $item->mahasiswa->nama : '' }}`,`{{ $item->proses }}`,`{{ $item->keterangan }}`)}">Keterangan</button>
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

    <!-- Open the modal using ID.showModal() method -->
    <dialog id="my_modal_1" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold" id="nama_mahasiswa">Hello!</h3>
            <p class="py-4" id="keterangan"></p>
            <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn">Tutup</button>
                </form>
            </div>
        </div>
    </dialog>

    <script>
        function tampil_data(mahasiswa, proses, keterangan) {
            let nama_mahasiswa = document.getElementById('nama_mahasiswa');
            let data_keterangan = document.getElementById('keterangan');

            nama_mahasiswa.innerHTML = `${mahasiswa} > ${proses}`;
            data_keterangan.innerHTML = keterangan;
        }
    </script>
@endsection

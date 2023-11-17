@extends('layout/main')

@section('container')
    @if (session()->has('message'))
        <div class="position-fixed mt-5 top-0 end-0 p-3" style="z-index: 11">
            <div id="toastNotification" class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
                <div id="toast-header"
                    class="toast-header @if (session('status') == true) text-success @else text-danger @endif">
                    <i class="fa-solid fa-square fa-xl"></i>
                    <strong class="ms-2 me-auto">{{ session('status') == true ? 'Success' : 'Failed' }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('message') }}
                </div>
            </div>
        </div>
    @endif

    <div class="body-white border rounded shadow mt-3">
        <div class="container mt-3">
            <div class="d-flex justify-content-between mb-3">
                <div class="">
                    <form action="">
                        <div class="input-group">
                            <input type="search" id="search" name="search" class="form-control"
                                placeholder="Cari Mahasiswa" value="{{ request('search') }}" />
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="">
                    <a class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#cariMahasiswaModal">Input
                        Nilai</a>
                </div>
            </div>
            <div class="div table-responsive">
                <table class="table table-striped text-center align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Mata Kuliah</th>
                            <th>Tanggal Ujian</th>
                            <th>Nilai Ujian</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataUjian as $item)
                            <tr>
                                <th>{{ $loop->index + 1 }}</th>
                                <td>{{ $item->nim }}</td>
                                <td>{{ $item->mahasiswa->nama_mahasiswa }}</td>
                                <td>{{ $item->matkul->matkul }}</td>
                                <td>{{ $item->tanggal_ujian }}</td>
                                <td>{{ $item->nilai }}</td>
                                <td>{{ $item->grade }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Cari Mahasiswa --}}
    <div class="modal fade" id="cariMahasiswaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="cariMahasiswaModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cari Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="nim_search" type="text" placeholder="NIM"
                                autocomplete="off" />
                            <label for="nim">NIM</label>
                            <div class="invalid-feedback">
                                <p id="messageError">Error Message</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary" id="searchNim">Cari</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Nilai Mahasiswa --}}
    <div class="modal fade" id="tambahNilaiModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="tambahNilaiModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="ujian" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Nilai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input class="form-control" name="nim" id="nim_show" type="text" placeholder="ID"
                                readonly />
                            <label for="nim">NIM</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" name="nama" id="nama_show" type="text" placeholder="nama"
                                readonly />
                            <label for="nama">Nama Mahasiswa</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="matkul" id="matkul" required>
                                <option value="default" selected disabled hidden>Pilih Mata Kuliah</option>
                                @foreach ($dataMatkul as $matkul)
                                    <option value="{{ $matkul->id }}">{{ $matkul->matkul }}</option>
                                @endforeach
                            </select>
                            <label for="matkul">Mata Kuliah</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" name="tanggal_ujian" id="tanggal_ujian" type="date"
                                placeholder="tanggal_ujian" />
                            <label for="tanggal_ujian">Tanggal Ujian</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" name="nilai" id="nilai" type="text"
                                placeholder="nilai" />
                            <label for="nilai">Nilai Ujian</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @include('../script/script')
@endsection

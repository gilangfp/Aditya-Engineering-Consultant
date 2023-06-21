@extends('templates.main')
@section("css")
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection
@section('container')
    <div class="container mb-5" style="margin-bottom: 10px;">
        <a type="button" class="btn btn-primary waves-effect mb-3" href="/jenis/tambahjenis">Tambah Jenis Kegiatan</a>
    </div>
    <div class="container mt-3">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Data Jenis Kegiatan
                        </h2>
                    </div>
                    <div class="body table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable"
                                id="proyek" class="display">
                            <thead>
                            <tr>
                                    <th>No</th>
                                    <th>Nama Departemen</th>
                                    <th>Nama Sub Departemen</th>
                                    <th>Jenis Kegiatan</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                    {{-- <th >Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($jenis_kegiatan as $jk)
                                    <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                        {{-- <td>{{ $jk->id }}</td> --}}
                                        <td>{{ $jk->nama_departemen }}</td>
                                        <td>{{ $jk->nama_sub }}</td>
                                        <td>{{ $jk->nama_kegiatan }}</td>
                                        <td>{{ date('d-M-Y', strtotime($jk->created_at)) }}</td>
                                        <td>
                                                <a href="/jenis/{{ $jk->id_jenis }}/ubah"
                                                    class="btn btn-success">Ubah</a>
                                                <span class="pull-right">
                                                @if (Auth::user()->id_level == 1)
                                                    <form action="/jenis/{{ $jk->id_jenis }}" method="post"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data jenis kegiatan ini?')">
                                                        @method('delete')
                                                        @csrf
                                                        <input class="btn btn-danger" type="submit" value="Hapus">
                                                        @endif
                                                    </form>
                                                </span>
                                            </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Table -->
    </div>
@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"> </script>
    <script>
        $(document).ready(function () {
                 $('#proyek').DataTable();
            });
    </script>

@endsection

@extends('templates.main')
@section("css")
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('container')
@if (Auth::user()->id_level == 1)
    <div class="container mb-5" style="margin-bottom: 10px;">
        <a type="button" class="btn btn-primary waves-effect mb-3" href="/laporankegiatan/tambahlaporankegiatan">Tambah
            Laporan Kegiatan</a>
            @endif

        @if (Auth::user()->id_level == 1)
            <a type="button" class="btn btn-success waves-effect mb-3" href="/laporankegiatan/export" target="_blank">Table Export PDF</a>
        @endif
    </div>
    {{-- <div class="container mb-5" style="margin-bottom: 10px;"></div> --}}
    <div class="container mt-3">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Laporan Kegiatan
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                       
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable"
                                id="tablelaporankegiatan">
                                <thead>
                                    <tr>
                                        
                                        <th>No</th>
                                        <th>Nama Karyawan</th>
                                        <th>Tahun Anggaran</th>
                                        <th>Kode Proyek</th>
                                        <th>Nama Proyek</th>
                                        <th>Departemen</th>
                                        <th>Jenis Kegiatan</th>
                                        <th>Deskripsi Singkat</th>
                                        
                                        <th>Status</th>
                                        <th>dibuat</th>
                                        @if (Auth::user()->id_level != 2)
                                        <th>approve?</th>
                                        @endif
                                        <th>Dokumen</th>
                                        {{--<th>Target</th> --}}
                                        @if (Auth::user()->id_level != 3)
                                        <th>Ubah</th>
                                        
                                        <th>Hapus</th>
                                        @endif
                                    </tr>
                                </thead>
                                 <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Karyawan</th>
                                        <th>Tahun Anggaran</th>
                                        <th>Kode Proyek</th>
                                        <th>Nama Proyek</th>
                                        <th>Departemen</th>
                                        <th>Jenis Kegiatan</th>
                                        <th>Deskripsi Singkat</th>
                                        
                                        <th>Status</th>
                                        <th>dibuat</th>
                                    </tr>
                                </tfoot> 
                                <tbody>
                                    @foreach ($laporankegiatan as $lk)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $lk->name }}</td>
                                            <td>{{ $lk->tahun }}</td>
                                            <td>{{ $lk->kode_proyek }}</td>
                                            <td>{{ $lk->nama_proyek }}</td>
                                            <td>{{ $lk->nama_departemen }}</td>
                                            <td>{{ $lk->nama_kegiatan }}</td>
                                            <td>{{ $lk->deskripsi }}</td>
                                            
                                           {{--<td><a href="{{ ('/laporankegiatan/view/{id}'.$lk->dokumentasi)}}" target="_blank"><button class="btn btn-succes" type="button">view</button></a></td>--}}
                                           @if ($lk->id_approve == 1)
                                            <td>
                                                <label class="label label-warning">{{ $lk->nama}}</label>
                                            </td>
                                            @elseif ($lk->id_approve == 3)
                                            <td>
                                                <label class="label label-danger">{{ $lk->nama}}</label>
                                            </td>
                                            @else
                                            <td>
                                                <label class="label label-success">{{ $lk->nama}}</label>
                                            </td>
                                            @endif
                                           <td>{{ date('d-M-Y', strtotime($lk->created_at)) }}</td> 
                                           {{-- <td>{{ $lk->target }}</td>--}}
                                           @if (Auth::user()->id_level != 2)    <td> 
                                                <a href="{{ url ('laporankegiatan/approve/'.$lk->id)}}">
                                                <i class="material-icons">done</i>
                                                </a>
                                                <span class="pull-mid">
                                               <a href="{{ url ('laporankegiatan/rejected/'.$lk->id)}}">
                                                <i class="material-icons">close</i>
                                                </a>
                                                        @endif
                                                    </form>
                                                </span>
                                            </td>
                                            
                                            <td><a href="dokumen/{{ $lk->dokumentasi }}" target="_blank"><button class="btn btn-succes" type="button">Download</button></a></td>
                                            @if (Auth::user()->id_level != 3)    
                                            <td><a href="/laporankegiatan/{{ $lk->id }}/ubah"
                                                    class="btn btn-success">Ubah</a></td>
                                               @endif
                                                @if (Auth::user()->id_level == 1)
                                                   <td> <form action="/laporankegiatan/{{ $lk->id }}" method="post"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data laporan kegiatan ini?')">
                                                        @method('delete')
                                                        @csrf
                                                        <input class="btn btn-danger" type="submit" value="Hapus">
                                                        @endif</td>
                                                    </form>
                                                </span>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
@endsection
@section('scripts')
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"> </script>
    <script>
        
      $(document).ready(function () {
    $('#tablelaporankegiatan').DataTable({
        initComplete: function () {
            this.api()
                .columns()
                .every(function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
 
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
 
                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                });
                
        },
        
    });
    
});
    </script>

@endsection

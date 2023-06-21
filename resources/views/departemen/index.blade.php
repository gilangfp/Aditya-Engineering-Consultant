@extends('templates.main')
@section("css")
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection
@section('container')
    <div class="container mb-5" style="margin-bottom: 10px;">
        <a type="button" class="btn btn-primary waves-effect mb-3" href="/departemen/tambahdepartemen">Tambah Departemen</a>
    </div>
    <div class="container mt-3">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Data Departemen
                        </h2>
                    </div>
                    <div class="body table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable"
                                id="proyek" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Departemen</th>
                                    <th>Ubah</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Departemen</th>
                                    
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($departemen as $d)
                                    <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $d->nama_departemen }}</td>
                                        <td>
                                            <a href="/departemen/{{ $d->id }}/ubah" class="btn btn-success">Ubah</a>
                                        </td>
                                        <td>
                                                <form action="/departemen/{{ $d->id }}" method="post"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data departemen ini?')">
                                                    @method('delete')
                                                    @csrf
                                                    <input class="btn btn-danger" type="submit" value="Hapus">
                                                </form>
                                            {{-- </span> --}}
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
        $('#proyek').DataTable({
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

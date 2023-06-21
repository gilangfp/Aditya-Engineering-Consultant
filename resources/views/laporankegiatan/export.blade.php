@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laporan Kegiatan</title>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

    </head>

    <body>
        <div class="container">
            <div class="container mb-5" style="margin-bottom: 10px;">
                <a type="button" class="btn btn-primary waves-effect mb-3" href="/laporankegiatan">Back To Laporan</a>
            </div>
            <div>
                <table id="myTable" class="display">
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
                        
                        <th>dibuat</th>
                        </tr>
                    </thead>
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
                            <td>{{ date('d-M-Y', strtotime($lk->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </body>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'pdfHtml5',
                    text: 'Export to PDF',
                    title: 'Tabel Laporan Kegiatan- export ' +
                        getCurrentDate(), // Set the title of the PDF
                    customize: function(doc) {
                        doc.defaultStyle.fontSize = 10; // Set the default font size

                        // Add a footer to each page
                        doc.footer = function(currentPage, pageCount) {
                            return {
                                text: 'Page ' + currentPage.toString() + ' of ' + pageCount
                                    .toString(),
                                alignment: 'center',
                                fontSize: 8
                            };
                        };
                    }
                }]
            });
        });

        function getCurrentDate() {
            var currentDate = new Date();
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1;
            var year = currentDate.getFullYear();
            return day + '-' + month + '-' + year;
        }
    </script>

    </html>
@endsection

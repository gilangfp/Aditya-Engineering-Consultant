@extends('templates.main')


@section('container')
    <div class="block-header">
        <h2>Tambah Data Laporan Kegiatan</h2>
    </div>
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <h2 class="card-inside-title">Form Laporan Kegiatan</h2>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            {{-- form --}}
                            {{-- {{ dd() }} --}}
                            <form method="post" action="/jenis/store" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                <p class="card-inside">Pilih Departemen</p>
                                    <select class="form-control" name="id" id="id">
                                        <option value="">-- Pilih Departemen --</option>
                                        @foreach ($departemen as $d)
                                            <option value="{{ $d->id }}">{{ $d->nama_departemen }} </option>
                                        @endforeach
                                    </select>
                                    @error('id_departemen')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <p class="card-inside">Pilih Sub Departemen</p>
                                <div class="form-group">
                                    <select class="form-control" name="id_sub" id="id_sub">
                                        
                                    </select>
                                    @error('id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                    <p class="card-inside">Jenis Kegiatan</p>
                                        <input type="text" class="form-control" placeholder="Masukan Jenis Kegiatan"
                                            id="nama_kegiatan" name="nama_kegiatan" />
                                    </div>
                                    @error('deskripsi')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>  


                                <input type="submit" name="submit" value="Save">

                            </form>
                            {{-- endform --}}
                        </div>
                    </div>
                @endsection
                @section('scripts')
    <script>

        var csrftoken = '{{ csrf_token() }}';

        $(document).ready(function(){
            var baseUrl = "<?=url('')?>";

            var handleGetSub = function(id_department) {
                $.ajax({
                    url: baseUrl + '/get-sub',
                    type: "post",
                    dataType: 'json',
                    data: {
                        id_department: id_department,
                        _token: csrftoken,
                    } ,
                    success: function (response) {
                        if(response.data.length == 0) return;

                        var options = '<option value="">- Pilih Sub</option>';

                        $.each(response.data, function(i, data) {
                            options += `<option value="${data.id_sub}">${data.nama_sub}</option>`;
                        })

                        $('#id_sub').html(options);
                        $('#id_sub').selectpicker("refresh");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }

            var handleGetKegiatan = function(id_sub) {
                $.ajax({
                    url: baseUrl + '/get-jenis-kegiatan',
                    type: "post",
                    dataType: 'json',
                    data: {
                        id_sub: id_sub,
                        _token: csrftoken,
                    } ,
                    success: function (response) {
                        if(response.data.length == 0) return;

                        var options = '<option value="">- Pilih Sub</option>';
                        
                        $.each(response.data, function(i, data) {
                            options += `<option value="${data.id_jenis}">${data.nama_kegiatan}</option>`;
                        })

                        $('#id_jenis').html(options);
                        $('#id_jenis').selectpicker("refresh");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }

            $('#id').on('change', function() {
                var id = $(this).find(':selected').val();
                handleGetSub(id);
            });

            
            $('#id_sub').on('change', function() {
                var sub_id = $(this).find(':selected').val();
                handleGetKegiatan(sub_id);
            });
            
        });
    </script>
@endsection


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
                            <form id="fileUploadForm"  method="post" action="/laporankegiatan/store" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="form-line">
                                        @if (Auth::user()->id_level != 1)
                                            <input type="hidden" class="form-control" placeholder="ID Karyawan"
                                                id="id_karyawan" name="id_karyawan" value="{{ Auth::user()->id }}" />
                                            <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                                readonly />
                                        @else
                                            <select class="form-control show-tick" name="id_karyawan" id="id_karyawan">
                                                @foreach ($karyawan as $k)
                                                    <option value="{{ $k->id }}">{{ $k->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                    </div>
                                </div>
                                <div class="form-group">
                                <label for ="tahunanggaran" class="col-md-4 col-form-label text-md-right">Tahun Anggaran </label>
                                    <select class="form-control show-tick" name="id_tahun" id="id_tahun">
                                        <option value="">-- Tahun Anggaran --</option>
                                        @foreach ($tahunanggaran as $t)
                                            <option value="{{ $t->id_tahun }}">{{ $t->tahun }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_proyek')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                <label for ="proyek" class="col-md-4 col-form-label text-md-right">Pilih Proyek </label>
                                    <select class="form-control show-tick" name="id_proyek" id="id_proyek">
                                    {{-- <option value="">-- Pilih Proyek --</option>
                                       @foreach ($proyek as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama_proyek }}</option>
                                        @endforeach--}}
                                    </select>
                                    @error('id_proyek')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                <label for ="proyek" class="col-md-4 col-form-label text-md-right">Departemen </label>
                                    <select class="form-control" name="id" id="id">
                                        <option value="">-- Pilih Departemen --</option>
                                        @foreach ($departemen as $d)
                                            <option value="{{ $d->id }}">{{ $d->nama_departemen }} </option>
                                        @endforeach
                                    </select>
                                    @error('id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label for ="sub" class="col-md-4 col-form-label text-md-right">Sub Departemen </label>
                                <div class="form-group">
                                    <select class="form-control" name="id_sub" id="id_sub">
                                        
                                    </select>
                                    @error('id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label for ="jenis" class="col-md-4 col-form-label text-md-right">Jenis Kegiatan </label>
                                <div class="form-group">
                                    <select class="form-control" name="id_jenis" id="id_jenis">
                                        
                                    </select>
                                    @error('id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                    <label for ="jenis" class="col-md-4 col-form-label text-md-right">Deskripsi Singkat </label>
                                        <input type="text" class="form-control" placeholder="Masukan Deskripsi Singkat Kegiatan"
                                            id="deskripsi" name="deskripsi" />
                                    </div>
                                    @error('deskripsi')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>  

                                <div class="form-group">
                                    <div class="form-line">
                                        <label for ="dokumentasi" class="col-md-4 col-form-label text-md-right">Dokumen </label>
                                        <input type="file" class="form-control" name="dokumentasi" id="dokumentasi" value="{{ old('dokumentasi') }}" />
                                    </div>
                                    <input type="hidden" class="form-control" placeholder="ID Karyawan"
                                                id="id_approve" name="id_approve" value="1" />
                                    
                                    @error('dokumen')
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

                        var options = '<option value="">- Pilih Jenis Kegiatan</option>';
                        
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
            // tahun anggaran
            var handleGetProyek = function(id_tahun) {
                $.ajax({
                    url: baseUrl + '/get-proyek',
                    type: "post",
                    dataType: 'json',
                    data: {
                        id_tahun: id_tahun,
                        _token: csrftoken,
                    } ,
                    success: function (response) {
                        if(response.data.length == 0) return;

                        var options = '<option value="">- Pilih Proyek</option>';
                        
                        $.each(response.data, function(i, data) {
                            options += `<option value="${data.id}">${data.nama_proyek}</option>`;
                        })

                        $('#id_proyek').html(options);
                        $('#id_proyek').selectpicker("refresh");
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
           // tahun anggaran 
            $('#id_tahun').on('change', function() {
                var id_tahun = $(this).find(':selected').val();
                handleGetProyek(id_tahun);
            });
            
        });
        
    </script>
@endsection

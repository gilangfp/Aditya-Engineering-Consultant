@extends('templates.main')


@section('container')
    <div class="block-header">
        <h2>Ubah Data Jenis Kegiatan</h2>
    </div>
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <h2 class="card-inside-title">Form Jenis Kegiatan</h2>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            {{-- form --}}
                                {{-- {{ dd($laporankegiatan) }} --}}
                                <form method="post" action="/jenis/{{ $jenis_kegiatan[0]->id_jenis }}">
                                @method('put')
                                @csrf
                                <div class="form-group">
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
                                
                                <div class="form-group">
                                    <select class="form-control" name="id_sub" id="id_sub">
                                        
                                    </select>
                                    @error('id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Masukan Jenis Kegiatan"
                                            id="nama_kegiatan" name="nama_kegiatan" value="{{ $jenis_kegiatan[0]->nama_kegiatan }}"/>
                                    </div>
                                    @error('nama_kegiatan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{--<div class="form-group">
                                    <select class="form-control show-tick" name="id_proyek" id="id_proyek">
                                         <option value="{{ $laporankegiatan[0]->id_proyek }}">{{ $tender[0]->nama_proyek }}</option>
                                        @foreach ($proyek as $p)
                                            @if ($p->id == $laporankegiatan[0]->id_proyek)
                                            <option value="{{ $p->id }}" selected>{{ $p->nama_proyek }}</option>      
                                            @else
                                            <option value="{{ $p->id }}" >{{ $p->nama_proyek }}</option>      
                                            @endif
                                        @endforeach
                                    </select>
                                </div>--}}

                               {{-- <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Masukan Ruas" id="ruas"
                                            name="ruas" value="{{ $laporankegiatan[0]->ruas }}"/>
                                    </div>
                                    @error('ruas')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>--}}
                                {{--<p class="card-inside">Start Proyek</p>
                                <div class="form-group">
                                    <div class="form-line" id="bs_datepicker_container"
                                        style="z-index: 10; display: block;">
                                        <input type="text" class="datepicker form-control"
                                            placeholder="Masukan Start proyek" name="start" id="start" value="{{ $laporankegiatan[0]->start }}">
                                    </div>
                                    @error('start')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>--}}
                                {{--<p class="card-inside">Target Proyek</p>
                                <div class="form-group">
                                    <div class="form-line" id="bs_datepicker_container"
                                        style="z-index: 10; display: block;">
                                        <input type="text" class="datepicker form-control"
                                            placeholder="Masukan Target proyek" name="target" id="target" value="{{ $laporankegiatan[0]->target }}">
                                    </div>
                                    @error('target')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>--}}

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

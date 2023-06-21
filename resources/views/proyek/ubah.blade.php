@extends('templates.main')


@section('container')

  <div class="block-header">
    <h2>Ubah Data proyek</h2>
</div>
<!-- Input -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <h2 class="card-inside-title"></h2>
                <div class="row clearfix">
                    <div class="col-sm-12">
                      {{-- form --}}
                      <form method="post" action="/proyek/{{ $proyek->id }}">
                        @method('put')  
                        @csrf 
                        <div class="form-group">
                          <div class="form-line">
                          <label for ="id_tahun">Kode Proyek </label>
                              <input type="text" class="form-control" placeholder="Kode Proyek" id="kode_proyek" name="kode_proyek" value="{{ $proyek->kode_proyek }}"/>
                          </div>
                      </div>                     
                        <div class="form-group">
                          <div class="form-line">
                          <label for ="id_tahun">Nama Proyek </label>
                              <input type="text" class="form-control" placeholder="Nama Proyek" id="nama_proyek" name="nama_proyek" value="{{ $proyek->nama_proyek }}"/>
                          </div>
                      </div>
                      <div class="form-group">
                                <label for ="id_tahun">Tahun Anggaran </label>
                                    <select class="form-control" name="id_tahun" id="id_tahun">
                                        <option value="">-- Pilih Tahun Anggaran --</option>
                                        @foreach ($tahunanggaran as $t)
                                            <option value="{{ $t->id_tahun }}">{{ $t->tahun }} </option>
                                        @endforeach
                                    </select>
                                    @error('id_tahun')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                        <p class="card-inside">Start Proyek</p>
                                <div class="form-group">
                                    <div class="form-line" id="bs_datepicker_container"
                                        style="z-index: 10; display: block;">
                                        <input type="text" class="datepicker form-control"
                                            placeholder="Masukan Target proyek" name="start" id="start">
                                    </div>
                                    @error('target')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <p class="card-inside">Target Proyek</p>
                                <div class="form-group">
                                    <div class="form-line" id="bs_datepicker_container"
                                        style="z-index: 10; display: block;">
                                        <input type="text" class="datepicker form-control"
                                            placeholder="Masukan Target proyek" name="target" id="target">
                                    </div>
                                    @error('target')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                        <input type="submit" name="submit" value="Save">

                      </form>
                        {{-- endform --}}
                    </div>
                </div>

 @endsection
@extends('templates.main')


@section('container')

  <div class="block-header">
    <h2>Tambah Data Proyek</h2>
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
                      <form method="post" action="/proyek/store" id="form1">
                        @csrf
                        <label for ="id_tahun">Kode Proyek </label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Kode Proyek" id="kode_proyek" name="kode_proyek"/>
                            </div>
                        </div>
                        <label for ="id_tahun">Nama Proyek </label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Nama Proyek" id="nama_proyek" name="nama_proyek"/>
                            </div>
                        </div>
                        <div class="form-group">
                                <label for ="id_tahun" >Tahun Anggaran </label>
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
                                <label for ="id_tahun">Start Proyek </label>
                                <div class="form-group">
                                    <div class="form-line" id="bs_datepicker_container"
                                        style="z-index: 10; display: block;">
                                        <input type="text" class="datepicker form-control"
                                            placeholder="Masukan Start proyek" name="start" id="start">
                                    </div>
                                    @error('start')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label for ="id_tahun">Target Proyek </label>
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

                        

                      </form>
                        {{-- endform --}}
                        {{-- form --}}
                      <form method="post" action="/proyek/store" id="form1">
                        @csrf
                        <label for ="id_tahun">Kode Proyek </label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Kode Proyek" id="kode_proyek" name="kode_proyek"/>
                            </div>
                        </div>
                        <label for ="id_tahun">Nama Proyek </label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Nama Proyek" id="nama_proyek" name="nama_proyek"/>
                            </div>
                        </div>
                        <div class="form-group">
                                <label for ="id_tahun" >Tahun Anggaran </label>
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
                                <label for ="id_tahun">Start Proyek </label>
                                <div class="form-group">
                                    <div class="form-line" id="bs_datepicker_container"
                                        style="z-index: 10; display: block;">
                                        <input type="text" class="datepicker form-control"
                                            placeholder="Masukan Start proyek" name="start" id="start">
                                    </div>
                                    @error('start')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label for ="id_tahun">Target Proyek </label>
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

                        

                      </form>
                      <button onclick="submitForms()">Submit All Forms</button>
                        {{-- endform --}}
                    </div>
                </div>

 @endsection

@section('scripts')
<script>
  function submitForms() {
  $('form').each(function() {
    $(this).submit();
  });
}
</script>
@endsection
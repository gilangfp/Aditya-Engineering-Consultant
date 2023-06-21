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
                      <form method="post" action="/sub/store">
                        @csrf
                        <div class="form-group">
                                <label for ="id_tahun" >Nama Departemen </label>
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
                        <label for ="id_tahun">Nama Sub Departemen </label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Nama Sub Departemen" id="nama_sub" name="nama_sub"/>
                            </div>
                        </div>
                        

                        <input type="submit" name="submit" value="Save">

                      </form>
                        {{-- endform --}}
                    </div>
                </div>

 @endsection

@section('scripts')
@endsection
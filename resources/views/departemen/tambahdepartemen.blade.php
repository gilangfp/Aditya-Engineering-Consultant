@extends('templates.main')


@section('container')

  <div class="block-header">
    <h2>Tambah Departemen</h2>
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
                      <form method="post" action="/departemen/store">
                        @csrf
                        </div>
                        <label for ="nama_departemen">Nama Departemen </label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Nama Departemen" id="nama_departemen" name="nama_departemen"/>
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
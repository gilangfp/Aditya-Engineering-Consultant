@extends('templates.main')


@section('container')
    <div class="block-header">
        <h2>Ubah Data Karyawan</h2>
    </div>
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <h2 class="card-inside-title">Form Karyawan</h2>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            {{-- {{ dd($karyawan) }} --}}
                            <form method="post" action="/karyawan/{{ $karyawan->id }}">
                                @method('put')
                                @csrf
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Masukan Nama Karyawan"
                                            id="name" name="name" value="{{ $karyawan->name }}" />
                                    </div>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Masukan Email"
                                            id="email" name="email" value="{{ $karyawan->email }}" />
                                    </div>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                <p>NOTE: Kosongkan Password jika tidak ingin diubah</p>
                                    <div class="form-line">
                                        <input type="password" class="form-control" placeholder="Masukan Password"
                                            id="password" name="password" autocomplete="new-password" />
                                    </div>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input placeholder="Masukan Password Lagi" id="password-confirm" type="password"
                                            class="form-control" name="password_confirmation"
                                            autocomplete="new-password" />
                                    </div>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row clearfix">
                                    <select class="form-control show-tick" name="id_level" id="id_level">
                                        <option value="">-- Please select --</option>
                                        @foreach ($level as $l)
                                            @if ($l->id == $karyawan->id_level)
                                            <option value="{{ $l->id }}" selected>{{ $l->nama_level }}</option>
                                            @else
                                            <option value="{{ $l->id }}">{{ $l->nama_level }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <input type="submit" name="submit" value="Save">

                            </form>
                            {{-- endform --}}
                        </div>
                    </div>
                @endsection

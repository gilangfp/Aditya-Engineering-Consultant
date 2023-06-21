@extends('templates/main')


@section('container')
    <div class="block-header">
        <h2>{{ __('Dashboard') }}</h2>
    </div>
    <div class="alert bg-green alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        {{ __('You are logged in!') }}
    </div>
    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">Total Laporan Kegiatan</div>
                    <div class="number count-to">{{$count_lk}} </div>   
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                <div class="text">Total  Laporan Kegiatan Approved</div>
                <div class="number count-to">{{$count_lk_acc}} </div> 
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                <div class="text">Total  Laporan Kegiatan Pending</div>
                <div class="number count-to">{{$count_lk_pend}} </div> 
                </div>
            </div>
        </div>
        @if (Auth::user()->id_level != 2)
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                <div class="text">Total  Users</div>
                <div class="number count-to">{{$count_users}} </div> 
                </div>
            </div>
        </div>
        @endif
    </div>
    
@endsection

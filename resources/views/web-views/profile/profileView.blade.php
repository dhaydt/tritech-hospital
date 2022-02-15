@extends('layouts.front-end.app')

@section('content')
<div class="container-fluid px-3 my--7">
    {{-- <div class="set-div">
        <a href="{{ route('profile.edit') }}"><i class="fas fa-cog mr-2"></i></a>
        <a href="{{ route('customersLogout') }}"><i class="fas fa-door-open"></i></a>
    </div> --}}
    <div class="row">
        <div class="col-12" style="z-index: 10">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="avatar avatar-profile" style="z-index: 1">
                        <img src="{{ asset('storage/profile').'/'.$data->image }}" alt="">
                    </div>
                </div>
            </div>
            <div class="card card-checkup profile my--6 pt-5 px-3" style="z-index: -1">
                <div class="bg-profile">
                    <img src="{{ asset('assets/front-end/img/checkup-bg.jpeg') }}" alt="">
                </div>
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Nama Lengkap</span><br>
                        <h5 class="field-content">{{ $data->name }}</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal Lahir</span><br>
                        <h5 class="field-content">{{ date('d-m-Y', strtotime($data->birth_date))}}</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Alamat lengkap</span><br>
                        <h5 class="field-content address">{{ $data->address }}</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Nomor Handphone</span><br>
                        <h5 class="field-content">{{ $data->phone }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

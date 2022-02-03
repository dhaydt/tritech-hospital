@extends('layouts.front-end.app')

@section('content')
<div class="con-content pt-0 my-6 pb-2">
    <div class="row">
        <div class="col-12">
            <div class="card card-checkup mb-3">
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Nama Lengkap</span><br>
                        <h5 class="field-content">{{ $data->customer->name }}</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal pemeriksaan</span><br>
                        <h5 class="field-content">{{ date('d-m-Y', strtotime($data->datang))}}</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Pemeriksaan kembali</span><br>
                        <h3 class="field-content">{{ date('d-m-Y', strtotime($data->kembali)) }}</h3>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

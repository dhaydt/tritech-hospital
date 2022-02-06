@extends('layouts.front-end.app')

@section('content')
<div class="con-content pt-0 my-6 pb-2">
    <div class="row">
        <div class="col-12">
            @if (count($data) > 0)
            @foreach ($data as $d)
            <div class="card card-checkup mb-3">
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Nama Layanan</span><br>
                        <h5 class="field-content">{{ $d->category }}</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Nama Lengkap</span><br>
                        <h5 class="field-content">{{ $d->customer->name }}</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal pemeriksaan</span><br>
                        <h5 class="field-content">{{ date('d-m-Y', strtotime($d->datang))}}</h5>
                    </div>
                    @if (isset($d->kembali))
                    <div class="field-group">
                        <span class="field-title">Pemeriksaan kembali</span><br>
                        <h3 class="field-content badge badge-success">{{ date('d M Y', strtotime($d->kembali)) }}</h3>
                    </div>
                    @else
                    <div class="field-group">
                        <span class="field-title">Pemeriksaan kembali</span><br>
                        <h3 class="field-content badge badge-danger text-danger" style="font-size: 14px; text-transform:unset;">Tidak ada tanggal kembali</h3>
                    </div>
                    @endif

                </div>
            </div>
            @endforeach
            @else
            <div class="row">
                <div class="col-12 justify-content-center d-flex align-items-center">
                    <h5 class="text-bold mb-0">Belum ada pemeriksaan</h5>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection

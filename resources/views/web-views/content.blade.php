@extends('layouts.front-end.app')
<style>
    .float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:20px;
	right:20px;
	background-color:#0C9;
	color:#FFF;
	border-radius:50px;
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}

.my-float{
	margin-top:22px;
}
</style>
@section('content')
@if (Route::is('content2'))
<div class="mt--5"></div>
<div class="back-menu">
    <a href="{{ url()->previous() }}" class="float">
        <i class="fas fa-bars my-float"></i>
    </a>
</div>
@endif
<div class="con-content pt-0 my-6 pb-2">
    <div class="row">
        <div class="col-12">
            <div class="konten-header">
                <div class="konten-img">
                    <img src="{{ asset('storage/content').'/'.$blog->image }}" alt="" class="img-konten">
                </div>
                <div class="konten-title mt-1">
                    <h5 class="mb-0">
                        {{ $blog->title }}
                    </h5>
                </div>
                <div class="konten-body">
                    {!! $blog->description !!}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

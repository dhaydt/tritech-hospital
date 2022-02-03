@extends('layouts.front-end.app')

@section('content')
<div class="container-fluid px-3 my-6">
    <div class="row">
        <div class="col-12">
            @foreach ($blog as $b)
            <div class="card blog-card mb-3">
                <a href="{{ route('content.view', ['id' => $b->id]) }}" class="img-link">
                    <img src="{{ asset('storage/content').'/'.$b['image'] }}" class="card-img-top" alt="blog-img">
                </a>
                <div class="card-body px-2 py-1">
                    <h5 class="card-title">{{ $b->title }}</h5>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@extends('layouts.front-end.app')

@section('content')
<div class="container-fluid px-3 my-6">
    <div class="row">
        @if (!Route::is('home2'))
        <div class="col-12 mb-3">
            <div class="row px-2">
                @foreach ($cat as $c)
                <div class="col-4 px-2">
                    <div class="card menu-card mb-3">
                        <a href="{{ route('checkup-cat', ['id' => $c->id]) }}" class="img-menu">
                            <img src="{{ asset('storage/category').'/'.$c['image'] }}" class="card-img-top" alt="menu-img">
                        </a>
                        <div class="card-body px-2 py-1 text-center d-flex align-items-center justify-content-center">
                            <label class="menu-title mb-0">{{ $c->name }}</label>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        <div class="col-12">
            <h4 class="section-title">
                Edukasi bagi anda
            </h4>
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
@push('script')
    <script>
        $(document).ready(function() {
        var maxHeight = 0;

        $('.menu-card').each(function(){
        var thisH = $(this).height();
        if (thisH > maxHeight) { maxHeight = thisH; }
        });

        $('.menu-card').height(maxHeight);
        })
    </script>
@endpush

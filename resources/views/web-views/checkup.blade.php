@extends('layouts.front-end.app')

@section('content')
@if (Route::is('checkup2'))
<div class="mt--5"></div>
@endif
<div class="con-content pt-0 my-6 pb-2">
    <div class="row">
        <div class="col-12">
            @if (!Route::is('checkup2'))

            @foreach ($kb as $n)
            <div class="card card-checkup new mb-3 bg-heart">
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Layanan :</span><br>
                        <h5 class="field-content">KB</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kembali :</span><br>
                        @if (isset($n->kembali))
                        <h5 class="field-content badge badge-success text-danger">
                            {{ date('d M Y', strtotime($n->kembali)) }}</h5>
                        @else
                        <h5 class="field-content">
                            -
                        </h5>
                        @endif
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kontrol terakhir :</span><br>
                        @if (isset($n->datang))
                        <h5 class="field-content">
                            {{ date('d M Y', strtotime($n->datang)) }}</h5>
                        @else
                        <h5 class="field-content">
                            -
                        </h5>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            @if (count($kb) == 0)
            <div class="card card-checkup new mb-3 bg-heart">
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Layanan :</span><br>
                        <h5 class="field-content">KB</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kembali :</span><br>
                        <h5 class="field-content">
                            -
                        </h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kontrol terakhir :</span><br>
                        <h5 class="field-content">
                            -
                        </h5>
                    </div>
                </div>
            </div>
            @endif

            @foreach ($hamil as $n)
            <div class="card card-checkup new mb-3 bg-greenPrim">
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Layanan :</span><br>
                        <h5 class="field-content">Kehamilan</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kembali :</span><br>
                        @if (isset($n->kembali))
                        <h5 class="field-content badge badge-success text-danger">
                            {{ date('d M Y', strtotime($n->kembali)) }}</h5>
                        @else
                        <h5 class="field-content">
                            -
                        </h5>
                        @endif
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kontrol terakhir :</span><br>
                        @if (isset($n->datang))
                        <h5 class="field-content">
                            {{ date('d M Y', strtotime($n->datang)) }}</h5>
                        @else
                        <h5 class="field-content">
                            -
                        </h5>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            @if (count($hamil) == 0)
            <div class="card card-checkup new mb-3 bg-greenPrim">
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Layanan :</span><br>
                        <h5 class="field-content">Kehamilan</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kembali :</span><br>
                        <h5 class="field-content">
                            -
                        </h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kontrol terakhir :</span><br>
                        <h5 class="field-content">
                            -
                        </h5>
                    </div>
                </div>
            </div>
            @endif

            @foreach ($lahir as $n)
            <div class="card card-checkup new mb-3 bg-yell">
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Layanan :</span><br>
                        <h5 class="field-content">Persalinan</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kembali :</span><br>
                        @if (isset($n->kembali))
                        <h5 class="field-content badge badge-success text-danger">
                            {{ date('d M Y', strtotime($n->kembali)) }}</h5>
                        @else
                        <h5 class="field-content">
                            -
                        </h5>
                        @endif
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kontrol terakhir :</span><br>
                        @if (isset($n->datang))
                        <h5 class="field-content">
                            {{ date('d M Y', strtotime($n->datang)) }}</h5>
                        @else
                        <h5 class="field-content">
                            -
                        </h5>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            @if (count($lahir) == 0)
            <div class="card card-checkup new mb-3 bg-yell">
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Layanan :</span><br>
                        <h5 class="field-content">Persalinan</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kembali :</span><br>
                        <h5 class="field-content">
                            -
                        </h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kontrol terakhir :</span><br>
                        <h5 class="field-content">
                            -
                        </h5>
                    </div>
                </div>
            </div>
            @endif

            @foreach ($imun as $i)
            <div class="card card-checkup new mb-3 bg-sea">
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Layanan :</span><br>
                        <h5 class="field-content">Imunisasi</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Imunisasi selanjutnya :</span><br>
                        <h5 class="field-content">
                            @if (isset($i->next_service))
                            {{ $i->next_service }}
                            @else
                            -
                            @endif
                        </h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kembali :</span><br>
                        @if (isset($i->kembali))
                        <h5 class="field-content badge badge-success text-danger">
                            {{ date('d M Y', strtotime($i->kembali)) }}</h5>
                        @else
                        <h5 class="field-content">
                            -
                        </h5>
                        @endif
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal imunisasi terakhir :</span><br>
                        @if (isset($i->datang))
                        <h5 class="field-content">
                            {{ date('d M Y', strtotime($i->datang)) }}</h5>
                        @else
                        <h5 class="field-content">
                            -
                        </h5>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            @if (count($imun) == 0)
            <div class="card card-checkup new mb-3 bg-sea">
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Layanan :</span><br>
                        <h5 class="field-content">KB</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Imunisasi selanjutnya :</span><br>
                        <h5 class="field-content">
                            -
                        </h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kembali :</span><br>
                        <h5 class="field-content">
                            -
                        </h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal imunisasi terakhir :</span><br>
                        <h5 class="field-content">
                            -
                        </h5>
                    </div>
                </div>
            </div>
            @endif

            @foreach ($nifas as $n)
            <div class="card card-checkup new mb-3 bg-heart">
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Layanan :</span><br>
                        <h5 class="field-content">Nifas</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kembali :</span><br>
                        @if (isset($n->kembali))
                        <h5 class="field-content badge badge-success text-danger">
                            {{ date('d M Y', strtotime($n->kembali)) }}</h5>
                        @else
                        <h5 class="field-content">
                            -
                        </h5>
                        @endif
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kontrol terakhir :</span><br>
                        @if (isset($n->datang))
                        <h5 class="field-content">
                            {{ date('d M Y', strtotime($n->datang)) }}</h5>
                        @else
                        <h5 class="field-content">
                            -
                        </h5>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            @if (count($nifas) == 0)
            <div class="card card-checkup new mb-3 bg-heart">
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Layanan :</span><br>
                        <h5 class="field-content">Nifas</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kembali :</span><br>
                        <h5 class="field-content">
                            -
                        </h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kontrol terakhir :</span><br>
                        <h5 class="field-content">
                            -
                        </h5>
                    </div>
                </div>
            </div>
            @endif

            @foreach ($repro as $r)
            <div class="card card-checkup new mb-3 bg-greenPrim">
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Layanan :</span><br>
                        <h5 class="field-content">Kesehatan reproduksi</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kembali :</span><br>
                        @if (isset($r->kembali))
                        <h5 class="field-content badge badge-success text-danger">
                            {{ date('d M Y', strtotime($r->kembali)) }}</h5>
                        @else
                        <h5 class="field-content">
                            -
                        </h5>
                        @endif
                    </div>

                    <div class="field-group">
                        <span class="field-title">Tanggal kontrol terakhir :</span><br>
                        @if (isset($r->datang))
                        <h5 class="field-content">
                            {{ date('d M Y', strtotime($r->datang)) }}</h5>
                        @else
                        <h5 class="field-content">
                            -
                        </h5>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            @if (count($repro) == 0)
            <div class="card card-checkup new mb-3 bg-greenPrim">
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Layanan :</span><br>
                        <h5 class="field-content">Kesehatan reproduksi</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal kembali :</span><br>
                        <h5 class="field-content">
                            -
                        </h5>
                    </div>

                    <div class="field-group">
                        <span class="field-title">Tanggal kontrol terakhir :</span><br>
                        <h5 class="field-content">
                            -
                        </h5>
                    </div>
                </div>
            </div>
            @endif
            @endif
        </div>

        @if (count($konten) > 0)
        <div class="col-12">
            <h4 class="section-title">
                Edukasi {{ session()->get('page-title') }}
            </h4>
            @foreach ($konten as $b)
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
        @endif
    </div>
</div>
</div>
@endsection

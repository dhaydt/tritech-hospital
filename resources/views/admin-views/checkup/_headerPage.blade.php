<div class="header bg-primary pb-8 pt-3 pt-md-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    {{-- <h6 class="h2 text-white d-inline-block mb-0">Tables</h6> --}}
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-2">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checkup</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <button type="button" class="btn btn-sm btn-neutral p-2" data-toggle="modal"
                        data-target="#modal-form">Add Checkup</button>
                    {{-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
                    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                        aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">

                                <div class="modal-body p-0">
                                    <div class="card bg-secondary border-0 mb-0">
                                        <div class="card-body px-lg-5 py-lg-5">
                                            <div class="text-center text-muted mb-4">
                                                <h4 class="uppercase">Register Checkup</h4>
                                            </div>
                                            <form class="js-validate" role="form" method="POST" action="{{route('admin.checkup.store')}}">
                                                @csrf
                                                <div class="form-group mb-3 pasien-form">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text w-100 bg-grey text-white capitalize">Pasien</span>
                                                        </div>
                                                        <select id="select-beast" class="form-select text-left" name="pasien_id" placeholder="Pilih pasien" autocomplete="off">
                                                            <option value="">Select a person...</option>
                                                            @foreach ($pasien as $p)
                                                            <option value="{{ $p['id'] }}">{{ $p['name'] }} <span class="text-red">({{ $p['phone'] }})</span></option>
                                                            @endforeach
                                                        </select>
                                                        {{-- <input class="pl-2 form-control" name="name" placeholder="Full Name" type="text"> --}}
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 pasien-form">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text w-100 bg-grey text-white">Keluhan</span>
                                                        </div>
                                                        <textarea class="pl-2 form-control" name="keluhan" ></textarea>
                                                    </div>
                                                </div>
                                                {{-- <div class="form-group mb-3 pasien-form">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text w-100 bg-grey text-white">Birth Date</span>
                                                        </div>
                                                        <input class="pl-2 form-control" name="birthdate" placeholder="Birthdate" type="date">
                                                    </div>
                                                </div> --}}

                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary my-4">Register Checkup</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        new TomSelect("#select-beast",{
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    </script>
@endpush

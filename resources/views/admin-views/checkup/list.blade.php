@extends('layouts.backend.app')
@section('title', 'Pasien Checkup')
@section('content')
@include('admin-views.checkup._headerPage')
<style>
    .viewUser {
        font-size: 22px;
        color: #5e72e4;
    }
    .card-footer {
        /* background-color: grey; */
    }
    .card-footer .row.justify-content-center .col-sm-auto .d-flex nav .flex {
        display: none;
    }
    .card-footer > div > div > div > nav > div.hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between > div:nth-child(1) > p {
        display: none;
    }
    .card-footer > div > div > div > nav > div.hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between > div:nth-child(2) > span {
        display: flex;
    }

    .card-footer > div > div > div > nav > div.hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between > div:nth-child(2) > span span:first-child span svg
    {
        margin-right: 15px;
    }
    .card-footer > div > div > div > nav > div.hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between > div:nth-child(2) > span > a:first-child svg{

    }
    .status.badge{
        font-size: 85%;
        border-radius: 20px;
    }

</style>
<div class="container-fluid mt--8">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                {{-- <div class="card-header border-0">
                    <h3 class="mb-0">Admin table</h3>
                </div> --}}
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" >
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col" class="sort" data-sort="name">NO</th>
                                <th scope="col" class="sort" data-sort="budget">Nama</th>
                                <th scope="col" class="sort" data-sort="status">Telepon / HP</th>
                                <th scope="col" class="sort" data-sort="status">Datang</th>
                                <th scope="col" class="sort" data-sort="status">Kembali</th>
                                <th scope="col" class="sort" data-sort="status">Alamat</th>
                                <th scope="col" class="sort" data-sort="completion">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @if (count($admin) > 0)
                            <?php $no = 1;?>
                            @foreach ($admin as $ad)
                            {{-- {{ dd($ad) }} --}}
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td class="budget text-center capitalize">
                                        <span class="status">{{ $ad->customer->name }}</span>
                                    </td>
                                    <td class="budget text-center capitalize">
                                        <span class="status">{{ $ad->customer->phone }}</span>
                                    </td>
                                    <td class="budget text-center capitalize">
                                        <span class="status badge badge-success">{{ date('d M Y',strtotime($ad->datang)) }}</span>
                                    </td>
                                    <td class="budget text-center capitalize">
                                        @if ($ad->kembali == null)
                                        <span class="status badge badge-danger">Belum di atur</span>

                                        @else
                                        <span class="status badge badge-success">{{ date('d M Y',strtotime($ad->kembali)) }}</span>
                                        @endif
                                    </td>
                                    <td class="budget text-center capitalize">
                                        <span class="status">{{ $ad->customer->address }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-evenly action-col">
                                            <a href="{{ route('admin.userCustomerView', ['id' => $ad['id']]) }}" class="viewUser">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            <a href="javascript:" class="viewUser">
                                                <i class="far fa-edit text-success"></i>
                                            </a>
                                            <a href="javascript:" class="viewUser">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- Card footer -->
                @if (count($admin) > 0)
                <div class="card-footer">
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                        <div class="col-sm-auto">
                            <div class="d-flex justify-content-center justify-content-sm-end">
                                <!-- Pagination -->
                                {!! $admin->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center p-4">
                    <img class="mb-3" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg"
                        alt="Image Description" style="width: 7rem;">
                    <p class="mb-0">No pasien data</p>
                </div>

                @endif
            </div>
        </div>
    </div>
    @endsection

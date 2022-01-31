@extends('layouts.backend.app')
@section('title', 'Customer List')
@section('content')
@include('admin-views.customer._headerPage')
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
                {{-- {{ var_dump($admin) }} --}}
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" >
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col" class="sort" data-sort="name">NO</th>
                                <th scope="col" class="sort" data-sort="name">ID</th>
                                <th scope="col" class="sort" data-sort="budget">Name</th>
                                <th scope="col" class="sort" data-sort="status">Phone</th>
                                <th scope="col" class="sort" data-sort="status">Address</th>
                                <th scope="col" class="sort" data-sort="completion">Action</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @if (count($admin) > 0)
                            <?php $no = 1;?>
                                @foreach ($admin as $ad)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body text-center">
                                                <span class="name mb-0 text-sm">{{ $ad['id'] }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="budget text-center capitalize">
                                        {{ $ad['name'] }}
                                    </td>
                                    <td class="text-center">
                                            <span class="status">{{ $ad['phone'] }}</span>
                                    </td>
                                    <td class="budget text-center capitalize">
                                        {{ $ad['address'] }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-evenly">
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

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
                                <th scope="col" class="sort" data-sort="name">ID</th>
                                <th scope="col" class="sort" data-sort="budget">Name</th>
                                <th scope="col" class="sort" data-sort="status">Email</th>
                                <th scope="col" class="sort" data-sort="status">Phone</th>
                                <th scope="col" class="sort" data-sort="status">Address</th>
                                <th scope="col">Profile Image</th>
                                <th scope="col" class="sort" data-sort="completion">Action</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @if (count($admin) > 0)
                                @foreach ($admin as $ad)
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            {{-- <a href="#" class="avatar rounded-circle mr-3">
                                                <img alt="Image placeholder" src="../assets/img/theme/bootstrap.jpg">
                                            </a> --}}
                                            <div class="media-body text-center">
                                                <span class="name mb-0 text-sm">{{ $ad['id'] }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="budget text-center">
                                        {{ $ad['name'] }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-dot mr-4">
                                            {{-- <i class="bg-warning"></i> --}}
                                            <span class="status">{{ $ad['email'] }}</span>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-dot mr-4">
                                            {{-- <i class="bg-warning"></i> --}}
                                            <span class="status">{{ $ad['phone'] }}</span>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="avatar-group">
                                            <a href="javascript:" class="avatar avatar-sm rounded-circle" data-toggle="tooltip"
                                                data-original-title="Ryan Tompson">
                                                <img alt="Image placeholder" src="{{ asset('storage/profile/'.$ad['image']) }}">
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <a href="{{ route('admin.userCustomerView', ['id' => $ad['id']]) }}" class="viewUser">
                                                <i class="far fa-eye"></i>
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

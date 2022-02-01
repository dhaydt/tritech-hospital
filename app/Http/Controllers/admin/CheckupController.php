<?php

namespace App\Http\Controllers\admin;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Checkup;
use App\Models\Customer;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckupController extends Controller
{
    public function index(Request $request)
    {
        $pasien = Customer::get();
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $admin = Checkup::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                            ->orWhere('phone', 'like', "%{$value}%")
                            ->orWhere('email', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $admin = Checkup::with(['customer']);
        }

        session()->put('title', 'Checkup List');
        $admin = $admin->latest()->paginate(Helpers::pagination_limit())->appends($query_param);

        return view('admin-views.checkup.list', compact('admin', 'search', 'pasien'));
    }

    public function store(Request $request)
    {
        $pasien = Customer::find($request['pasien_id']);
        // dd($pasien);
        $checkup = new Checkup();

        $checkup->pasien_id = $request['pasien_id'];
        $checkup->datang = Carbon::now();
        $checkup->save();
        Toastr::success('Pasien berhasil di daftarkan');

        return back();
    }
}

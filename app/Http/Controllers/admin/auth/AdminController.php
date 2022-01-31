<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $numb = strval((int) $request['phone']);
        $admin = Admin::where('email', $request->email)->orWhere('phone', $request->phone)->first();
        if (isset($admin)) {
            Toastr::warning('Email or phone already exist');

            return redirect()->back();
        }

        $request->validate([
            'name' => 'required',
            'phone' => 'unique:admins',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8|same:c_password',
        ]);

        $admin = Admin::create([
            'name' => $request['name'],
            'phone' => $numb,
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        Toastr::success('Admin successfully created');

        return redirect()->back();
    }

    public function addCustomer(Request $request)
    {
        // dd($request);
        $numb = strval((int) $request['phone']);
        $admin = Customer::where('phone', $request->phone)->first();
        if (isset($admin)) {
            Toastr::warning('Phone already exist');

            return redirect()->back();
        }

        $request->validate([
            'name' => 'required',
            'phone' => 'unique:admins',
            'address' => 'required',
            // 'email' => 'required|email|unique:admins',
            // 'password' => 'required|min:4|same:c_password',
        ]);

        $admin = Customer::create([
            'name' => $request['name'],
            'phone' => $numb,
            'image' => 'profile.png',
            'birth_date' => $request['birthdate'],
            'address' => $request['address'],
            'password' => bcrypt('1234'),
        ]);

        Toastr::success('Pasien successfully created');

        return redirect()->back();
    }
}

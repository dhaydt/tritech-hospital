<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        // dd(auth('customer')->user());
        if (auth('customer')->user() == null) {
            return redirect()->route(('customersLogin'));
        }

        return view('web-views.home');
    }

    public function checkout_complete(Request $request)
    {
        session()->put('payment', $request['payment_method']);

        $data = [
            'name' => 'Transaksi berhasil',
        ];
        session()->put('category', $data);

        return view('web-views.checkout-complete');
    }

    public function shipping()
    {
        return view('web-views.shipping');
    }
}

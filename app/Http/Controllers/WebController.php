<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Checkup;
use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        $user = auth('customer')->id();
        if (auth('customer')->user() == null) {
            return redirect()->route(('customersLogin'));
        }

        $blog = Content::orderBy('id', 'DESC')->get();
        $cat = category::orderBy('id', 'DESC')->get();

        session()->put('page-title', 'home');

        return view('web-views.home', compact('blog', 'cat'));
    }

    public function getKembali()
    {
        $user = auth('customer')->id();
        $date = Carbon::now()->format('Y-m-d');
        $check = Checkup::where(['pasien_id' => $user, 'kembali' => $date])->get();
        dd($check, $date);
    }

    public function content($id)
    {
        if (auth('customer')->user() == null) {
            return redirect()->route(('customersLogin'));
        }
        $blog = Content::where('id', $id)->first();
        session()->put('page-title', 'Edukasi');

        return view('web-views.content', compact('blog'));
    }

    public function checkup()
    {
        if (auth('customer')->user() == null) {
            return redirect()->route(('customersLogin'));
        }
        $id = auth('customer')->user()->id;
        $data = Checkup::with('customer')->latest('created_at')->where('pasien_id', $id)->get();
        // dd($data);
        session()->put('page-title', 'Pemeriksaan');

        return view('web-views.checkup', compact('data'));
    }

    public function checkupSingle($id)
    {
        if (auth('customer')->user() == null) {
            return redirect()->route(('customersLogin'));
        }
        $check = category::where('id', $id)->first();
        $ids = auth('customer')->id();
        $data = Checkup::with('customer')->latest('created_at')->where(['pasien_id' => $ids, 'cat_id' => $id])->get();
        // dd($data);
        $konten = Content::where('cat_id', $id)->orderBy('created_at', 'DESC')->get();
        // dd($konten, $id);
        session()->put('page-title', $check->name);

        return view('web-views.checkup', compact('data', 'konten'));
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

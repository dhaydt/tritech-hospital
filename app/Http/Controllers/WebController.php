<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Checkup;
use App\Models\Content;
use App\Models\Customer;
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
        $cat = category::orderBy('id', 'ASC')->get();

        session()->put('page-title', 'home');

        return view('web-views.home', compact('blog', 'cat'));
    }

    public function home2()
    {
        $blog = Content::orderBy('id', 'DESC')->get();
        $cat = category::orderBy('id', 'DESC')->get();

        session()->put('page-title', 'home');

        return view('web-views.home2', compact('blog', 'cat'));
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

    public function content2($id)
    {
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
        $kb = Checkup::where(['pasien_id' => $id, 'cat_id' => 1])->get();
        $hamil = Checkup::where(['pasien_id' => $id, 'cat_id' => 2])->get();
        $lahir = Checkup::where(['pasien_id' => $id, 'cat_id' => 3])->get();
        $imun = Checkup::where(['pasien_id' => $id, 'cat_id' => 5])->get();
        $nifas = Checkup::where(['pasien_id' => $id, 'cat_id' => 4])->get();
        $repro = Checkup::where(['pasien_id' => $id, 'cat_id' => 6])->get();
        // dd($data);
        session()->put('page-title', 'Pemeriksaan');
        $konten = [];

        return view('web-views.checkup', compact('data', 'konten', 'kb', 'imun', 'hamil', 'lahir', 'nifas', 'repro'));
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

        return view('web-views.checkup2', compact('data', 'konten'));
    }

    public function checkupSingleApi($id)
    {
        // if (auth('customer')->user() == null) {
        //     return redirect()->route(('customersLogin'));
        // }
        $check = category::where('id', $id)->first();
        $ids = auth('customer')->id();
        // $data = Checkup::with('customer')->latest('created_at')->where(['pasien_id' => $ids, 'cat_id' => $id])->get();
        // dd($data);
        $konten = Content::where('cat_id', $id)->orderBy('created_at', 'DESC')->get();
        // dd($konten, $id);
        session()->put('page-title', $check->name);

        return view('web-views.checkup2', compact('konten'));
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

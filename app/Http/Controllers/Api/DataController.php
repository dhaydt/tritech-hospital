<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Checkup;
use App\Models\Content;
use App\Models\Customer;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = Customer::where('phone', $request['no_hp_lama'])->first();
        $user->name = $request['nama'];
        $user->address = $request['alamat'];
        $user->phone = $request['no_hp'];
        $user->password = bcrypt($request['password']);
        $user->save();

        return 'sukses update data';
        // dd($user);
    }

    public function checkup(Request $request)
    {
        // dd($request);
        $user = Customer::where('phone', $request['phone'])->first();
        // $user = Customer::where('phone', $request['phone'])->first();
        if (!$user) {
            $respon = 'pasien tidak ditemukan';

            return response()->json($respon, 200);
        }
        $check = Checkup::with('customer')->where('pasien_id', $user->id)->orderby('created_at', 'DESC')->first();
        if (!$check) {
            $respon = '-';

            return response()->json($respon, 200);
        }
        $name = $check->customer->name;
        $datang = date('d-m-Y', strtotime($check->datang));
        $kembali = date('d-m-Y', strtotime($check->kembali));
        $respon = $name.', '.$datang.', '.$kembali;
        // dd($respon);

        return $respon;
    }

    public function profile(Request $request)
    {
        $user = Customer::where('phone', $request['phone'])->first();
        // $user = Customer::where('phone', $request['phone'])->first();
        // $check = Checkup::with('customer')->where('pasien_id', $user)->orderby('created_at', 'DESC')->first();
        if (!$user) {
            $respon = 'belum ada data';

            return response()->json($respon, 200);
        }
        $name = $user->name;
        $lahir = date('d-m-Y', strtotime($user->birth_date));
        $address = $user->address;
        $phone = $user->phone;
        $respon = $name.', '.$lahir.', '.$address.', '.$phone;
        // dd($respon);

        return $respon;
    }

    public function categoryCheckup(Request $request)
    {
        // dd($request);
        $user = Customer::where('phone', $request['phone'])->first();
        if (!isset($user)) {
            return 'pasien tidak ditemukan';
        }
        $cat = category::where('id', $request['cat_id'])->first();
        $check = Checkup::where(['pasien_id' => $user->id, 'cat_id' => $request['cat_id']])->latest('datang')->first();

        $layanan = $cat->name;
        $nama = $user->name;
        if ($check) {
            $datang = date('d-m-Y', strtotime($check->datang));
            $kembali = date('d-m-Y', strtotime($check->kembali));
            if (!isset($check->kembali)) {
                $kembali = '-';
            }
        } else {
            $datang = '-';
            $kembali = '-';
        }
        if ($cat->id == 5) {
            if (!isset($check->next_service)) {
                $imun = '-';
            } else {
                $imun = $check->next_service;
            }
            $resp = $layanan.', '.$nama.', '.$datang.', '.$kembali.', '.$imun;

            return $resp;
        }
        $resp = $layanan.', '.$nama.', '.$datang.', '.$kembali;

        return $resp;
        // dd($resp);
    }

    public function content(Request $request)
    {
        // dd($request);
        if ($request['category']) {
            $data = Content::where('cat_id', $request['category'])->orderby('id', 'DESC')->get();
        } else {
            $data = Content::orderby('id', 'DESC')->get();
        }
        function append_string($inc, $kontent)
        {
            $inc .= $kontent;

            // Returning the result
            return $inc;
        }
        $inc = '';
        foreach ($data as $d) {
            $img = env('APP_URL').'storage/content/'.$d->image;
            $title = $d->title;
            $create = $d->created_at;
            $createby = 'Admin';
            $desc = $d->description;
            $kontent = $img.' | '.$title.' | '.$create.' | '.$createby.' | '.$desc.', ';
            $inc = append_string($inc, $kontent);
        }
        // dd($inc);

        return $inc;
    }
}

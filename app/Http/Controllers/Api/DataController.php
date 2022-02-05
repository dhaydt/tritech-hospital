<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Checkup;
use App\Models\Customer;
use Illuminate\Http\Request;

class DataController extends Controller
{
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
            $respon = 'belum ada data pemeriksaan';

            return response()->json($respon, 200);
        }
        $name = $check->customer->name;
        $datang = date('d-m-Y', strtotime($check->datang));
        $kembali = date('d-m-Y', strtotime($check->kembali));
        $respon = $name.'" '.$datang.'" '.$kembali;
        // dd($respon);

        return response()->json($respon, 200);
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
        $respon = $name.'" '.$lahir.'" '.$address.'" '.$phone;

        return response()->json($respon, 200);
    }
}

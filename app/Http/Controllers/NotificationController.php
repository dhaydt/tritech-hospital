<?php

namespace App\Http\Controllers;

use App\Models\Checkup;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function saveToken(Request $request)
    {
        $id = auth('customer')->id();
        $user = Customer::where('id', $id)->first();

        $user->device_token = $request->token;
        $user->save();
        // auth('customer')->user()->save(['device_token' => $request->token]);

        return response()->json(['token saved successfully.']);
    }

    public function sendNotification($c)
    {
        $user = Customer::where('id', $c->pasien_id)->pluck('device_token')->all();
        $service = $c->cat_id;
        // $firebaseToken = Customer::whereNotNull('device_token')->pluck('device_token')->first();
        $firebaseToken = $user;
        // dd($firebaseToken);

        $SERVER_API_KEY = 'AAAAFhS4gQE:APA91bGqQ7NDoEieUd6hRvRJagJ-nnxWBp7fuh7Z1Qmz8Z7O2NRTwG2hFj-BOf3-xpYATs7RLN5aSScaLUgND1ghyjEChXqdMQFsJNS-vvu_YvIZ-_Hiuwpv6FfSazM4kdKV36Glg0p7';

        $data = [
            'registration_ids' => $firebaseToken,
            'notification' => [
                'title' => 'Bidan Ratna Dewi',
                'body' => 'Sudah waktu nya berobat ('.$service.')',
                'content_available' => true,
                'priority' => 'high',
            ],
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key='.$SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        return;
    }

    public function getKembali()
    {
        $date = Carbon::now()->format('Y-m-d');
        $check = Checkup::get();
        // if($)
        foreach ($check as $c) {
            // dd($c->kembali, $date);
            if ($c->kembali == $date) {
                return $this->sendNotification($c);
            }
        }

        return 'no';
    }

    public function getDateWa()
    {
        $check = Checkup::get();
        $dateMin = Carbon::now()->addDay(1)->format('Y-m-d');
        foreach ($check as $c) {
            $id = [];
            if ($c->kembali == $dateMin) {
                array_push($id, $c->id);
            }
        }

        return redirect()->route('notifWa', ['id[]' => $id]);
    }

    public function notifWa(Request $request)
    {
        $check = Checkup::get();
        $dateMin = Carbon::now()->addDay(1)->format('Y-m-d');
        $checkupId = [];
        foreach ($check as $c) {
            if ($c->kembali == $dateMin) {
                array_push($checkupId, $c->id);
            }
        }

        $this->sendWa($checkupId);
    }

    public function sendWa($checkupId)
    {
        var_dump($checkupId);
        if (count($checkupId) > 0) {
            foreach ($checkupId as $c) {
                $checkup = Checkup::where('id', $c)->first();
                $cat = $checkup->cat_id;
                $receiver = Customer::where('id', $checkup->pasien_id)->first()->phone;

                // $msg = 'Waktunya pemeriksaan '.$checkup->category.' esok hari';

                $msg = 'Salam sehat Bunda, Besok saatnya melakukan pemeriksaan di praktek ——Bidan Ratna Dewi——

Info lebih lanjut Hub: +6282247828037';

                if ($cat == 1) {
                    $msg = 'Salam sehat Bunda, Besok jadwal suntik KB ulang, Ingat selalu membawa kartu KB nya, Bunda. Kami tunggu kehadirannya di praktek ——Bidan Ratna Dewi——

Info lebih lanjut Hub: +6282247828037';
                }
                if ($cat == 2) {
                    $msg = 'Salam sehat Bunda, Besok saatnya melakukan pemeriksaan kehamilan Ingat selalu membawa buku pink (KIA) nya, Bunda. Kami tunggu kehadirannya di praktek ——Bidan Ratna Dewi——

Info lebih lanjut Hub: +6282247828037';
                }
                if ($cat == 3) {
                    $msg = 'Salam sehat Bunda, Besok saatnya melakukan pemeriksaan kembali untuk persiapan persalinan. Kami tunggu kehadirannya di praktek ——Bidan Ratna Dewi——
Info lebih lanjut Hub: +6282247828037';
                }
                if ($cat == 4) {
                    $msg = 'Salam sehat Bunda, Besok jadwal kontrol nifas (pasca salin) dan kontrol baby Ingat selalu membawa buku pink (KIA) nya, Bunda. Kami tunggu kehadiran Bunda & baby di praktek ——Bidan Ratna Dewi——
Info lebih lanjut Hub: +6282247828037';
                }
                if ($cat == 5) {
                    $msg = 'Salam sehat Bunda, Mengingatkan untuk Besok hari MINGGU untuk mengajak putra putri nya untuk mendapatkan imunisasi wajib imunisasi BCG, dari pukul 08.00-11.00 wita DPT, polio dari jam 08.00-14.00 wita imun MR dan JE dari jam 08.00-14.00 wita imun IPV dari jam 08.00-14.00 wita ——Bidan Ratna Dewi——
Info lebih lanjut Hub: +6282247828037';
                }
                if ($cat == 6) {
                    $msg = 'Salam sehat Bunda, Besok saatnya melakukan pemeriksaan kesehatan Reproduksi. Kami tunggu kehadirannya di praktek ——Bidan Ratna Dewi——
Info lebih lanjut Hub: +6282247828037';
                }

                // var_dump($msg);

                $userkey = 'd838134a05f6';
                $passkey = 'f52ce10b8a0a36be168524ab';
                $telepon = '+62'.(int) $receiver;
                // $message = $msg;
                $message = $msg;
                $url = 'https://console.zenziva.net/wareguler/api/sendWA/';
                $curlHandle = curl_init();
                curl_setopt($curlHandle, CURLOPT_URL, $url);
                curl_setopt($curlHandle, CURLOPT_HEADER, 0);
                curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
                curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
                curl_setopt($curlHandle, CURLOPT_POST, 1);
                curl_setopt($curlHandle, CURLOPT_POSTFIELDS, [
                    'userkey' => $userkey,
                    'passkey' => $passkey,
                    'to' => $telepon,
                    'message' => $message,
                ]);
                $results = json_decode(curl_exec($curlHandle), true);
                curl_close($curlHandle);
            }
        }
    }
}

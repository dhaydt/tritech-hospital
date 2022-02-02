<?php

namespace App\Http\Controllers\admin;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $admin = Admin::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                            ->orWhere('phone', 'like', "%{$value}%")
                            ->orWhere('email', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $admin = Admin::get();
        }

        session()->put('title', 'Admin list');
        if (count($admin) > 0) {
            $admin = $admin->last()->paginate(Helpers::pagination_limit())->appends($query_param);

            return view('admin-views.admin.list', compact('admin', 'search'));
        }

        return view('admin-views.admin.list', compact('admin', 'search'));
    }

    public function profile()
    {
        session()->put('title', 'Profile');

        return view('admin-views.admin.profile.editAdmin');
    }

    public function adminInfo(Request $request)
    {
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ];
        if (auth('admin')->check()) {
            Admin::where(['id' => auth('admin')->id()])->update($data);
            Toastr::info('Update data berhasil.');

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function adminPass(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
        ]);
        if ($request['password'] != $request['c_password']) {
            Toastr::error('Password tidak sama.');

            return back();
        }

        $data = [
            'password' => bcrypt($request->password),
        ];
        if (auth('admin')->check()) {
            Admin::where(['id' => auth('admin')->id()])->update($data);
            Toastr::info('Password berhasil diganti');

            return redirect()->back();
        } else {
            Toastr::error('Gagal mengganti password');

            return redirect()->back();
        }
    }

    public function adminPict(Request $request)
    {
        $img = $request->file('image');
        // dd($img);
        if (!isset($img)) {
            Toastr::error('Pilih avatar anda');
        }

        $imageName = ImageManager::update('profile/', auth('admin')->user()->image, 'png', $img);

        Admin::where('id', auth('admin')->id())->update([
            'image' => $imageName,
        ]);
    }

    public function customerList(Request $request, $status)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            // dd($request);
            $key = explode(' ', $request['search']);
            $admin = Customer::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                            ->orWhere('phone', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
            $admin = $admin->latest()->paginate(Helpers::pagination_limit())->appends($query_param);

            return view('admin-views.customer.list', compact('admin', 'search'));
        } else {
            $admin = Customer::get();
        }

        session()->put('title', 'Pasien list');
        // dd(count($admin) > 0);
        if (count($admin) > 0) {
            $admin = $admin->last()->paginate(Helpers::pagination_limit())->appends($query_param);

            return view('admin-views.customer.list', compact('admin', 'search'));
        }

        return view('admin-views.customer.list', compact('admin', 'search'));
    }

    public function customerView($id)
    {
        // dd($id);
        $user = Customer::where('id', $id)->first();
        session()->put('title', 'Pasien Details');

        return view('admin-views.customer.view.view', compact('user'));
    }

    public function delete($id)
    {
        $user = Customer::where('id', $id)->first();
        $user->delete();
        Toastr::success('Pasien sukses dihapus');

        return redirect()->back();
    }
}

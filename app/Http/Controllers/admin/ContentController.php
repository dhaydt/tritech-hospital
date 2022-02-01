<?php

namespace App\Http\Controllers\admin;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Models\Content;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        // $pasien = Customer::get();
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $admin = Content::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('title', 'like', "%{$value}%")
                            ->orWhere('content', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $admin = Content::get();
        }
        $last = $admin->last();
        if (isset($last)) {
            $admin = $admin->last()->paginate(Helpers::pagination_limit())->appends($query_param);
        }
        session()->put('title', 'Konten List');

        return view('admin-views.content.list', compact('admin', 'search'));
    }

    public function add()
    {
        return view('admin-views.content.addNew');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required',
            'desc' => 'required',
        ], [
            'image.required' => 'Konten images is required!',
            'title.required' => 'Title is required!',
            'desc.required' => 'Description  is required!',
        ]);
        $checkup = new Content();

        $checkup->title = $request['title'];
        $checkup->description = $request['desc'];
        $checkup->image = ImageManager::upload('content/', 'png', $request->file('image'));

        $checkup->save();
        Toastr::success('Pasien berhasil di daftarkan');

        return back();
    }

    public function update(Request $request)
    {
        $pasien = Content::where('id', $request->id)->first();
        $pasien->title = $request->title;
        $pasien->description = $request->desc;
        if ($request->file('image')) {
            $pasien->image = ImageManager::update('content/', $pasien->image, 'png', $request->file('image'));
        }
        $pasien->save();
        Toastr::success('Data kembali berhasil ditambahkan');

        return back();
    }

    public function delete($id)
    {
        // dd($id);
        $pasien = Content::where('id', $id)->first();
        ImageManager::delete('/content/'.$pasien->image);
        $pasien->delete();
        Toastr::success('Data checkup berhasil dihapus');

        return back();
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $banners = Banner::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('banner_type', 'like', "%{$value}%");
                }
            })->orderBy('id', 'desc');
            $query_param = ['search' => $request['search']];
        } else {
            $banners = Banner::orderBy('id', 'desc');
        }
        $banners = $banners->paginate(Helpers::pagination_limit())->appends($query_param);
        session()->put('title', 'Banner Configuration');

        return view('admin-views.banner.view', compact('banners', 'search'));
    }

    public function store(Request $request)
    {
        if ($request->banner_type == 'Header Banner') {
            $request->validate([
                'url' => 'required',
                'url2' => 'required',
                'image' => 'required',
            ], [
                'url.required' => 'Playstore url is required!',
                'url2.required' => 'AppStore url is required!',
                'image.required' => 'Image is required!',
            ]);

            $banner = new Banner();
            $banner->banner_type = $request->banner_type;
            $banner->url = $request->url;
            $banner->url2 = $request->url2;
            $banner->photo = ImageManager::upload('banner/', 'png', $request->file('image'));
            $banner->save();
            Toastr::success('Banner added successfully!');

            return back();
        }
        $request->validate([
            'url' => 'required',
            'image' => 'required',
        ], [
            'url.required' => 'url is required!',
            'image.required' => 'Image is required!',
        ]);

        $banner = new Banner();
        $banner->banner_type = $request->banner_type;
        $banner->url = $request->url;
        $banner->photo = ImageManager::upload('banner/', 'png', $request->file('image'));
        $banner->save();
        Toastr::success('Banner added successfully!');

        return back();
    }

    public function status(Request $request)
    {
        if ($request->ajax()) {
            $banner = Banner::find($request->id);
            $banner->published = $request->status;
            $banner->save();
            $data = $request->status;

            return response()->json($data);
        }
    }

    public function edit(Request $request)
    {
        $data = Banner::where('id', $request->id)->first();

        return response()->json($data);
    }

    public function update(Request $request)
    {
        if ($request->banner_type == 'Header Banner') {
            $request->validate([
                'url' => 'required',
                'url2' => 'required',
            ], [
                'url.required' => 'Playstore url is required!',
                'url2.required' => 'Appstore url is required!',
            ]);
            $banner = Banner::find($request->id);
            $banner->banner_type = $request->banner_type;
            $banner->url = $request->url;
            $banner->url2 = $request->url2;
            if ($request->file('image')) {
                $banner->photo = ImageManager::update('banner/', $banner['photo'], 'png', $request->file('image'));
            }

            $banner->save();

            // return response()->json();
            Toastr::success('Banner updated successfully!');
        }
        $request->validate([
            'url' => 'required',
        ], [
            'url.required' => 'url is required!',
        ]);
        $banner = Banner::find($request->id);
        $banner->banner_type = $request->banner_type;
        $banner->url = $request->url;
        if ($request->file('image')) {
            $banner->photo = ImageManager::update('banner/', $banner['photo'], 'png', $request->file('image'));
        }

        $banner->save();

        // return response()->json();
        Toastr::success('Banner updated successfully!');

        return back();
    }

    public function delete(Request $request)
    {
        $br = Banner::find($request->id);
        ImageManager::delete('/banner/'.$br['photo']);
        $br->delete();

        return response()->json();
    }
}

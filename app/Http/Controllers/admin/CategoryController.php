<?php

namespace App\Http\Controllers\admin;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $categories = Category::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $categories = Category::where(['position' => 0]);
        }

        $categories = $categories->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        session()->put('title', 'Categories');

        return view('admin-views.category.view', compact('categories', 'search'));
    }

    public function fetch(Request $request)
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
        ], [
            'name.required' => 'Category name is required!',
            'image.required' => 'Category image is required!',
        ]);

        $category = new Category();
        $category->name = $request->name[array_search('en', $request->lang)];
        $category->slug = Str::slug($request->name[array_search('en', $request->lang)]);
        $category->icon = ImageManager::upload('category/', 'png', $request->file('image'));
        $category->parent_id = 0;
        $category->position = 0;
        $category->save();

        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, [
                    'translationable_type' => 'App\Model\Category',
                    'translationable_id' => $category->id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ]);
            }
        }

        Toastr::success('Category added successfully!');

        return back();
    }

    public function edit($id)
    {
        $category = category::withoutGlobalScopes()->find($id);

        return view('admin-views.category.category-edit', compact('category'));
    }

    public function update(Request $request)
    {
        $category = Category::find($request->id);
        $category->name = $request->name[array_search('en', $request->lang)];
        $category->slug = Str::slug($request->name[array_search('en', $request->lang)]);
        if ($request->image) {
            $category->icon = ImageManager::update('category/', $category->icon, 'png', $request->file('image'));
        }
        $category->save();

        Toastr::success('Category updated successfully!');

        return back();
    }

    public function delete(Request $request)
    {
        $categories = Category::where('parent_id', $request->id)->get();
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $categories1 = Category::where('parent_id', $category->id)->get();
                if (!empty($categories1)) {
                    foreach ($categories1 as $category1) {
                        Category::destroy($category1->id);
                    }
                }
                Category::destroy($category->id);
            }
        }
        Category::destroy($request->id);

        return response()->json();
    }

    public function status(Request $request)
    {
        $category = Category::find($request->id);
        $category->home_status = $request->home_status;
        $category->save();
        Toastr::success('Service status updated!');

        return back();
    }
}

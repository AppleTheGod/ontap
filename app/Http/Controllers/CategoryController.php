<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        // $i = session('i', 1);
        $categories = Category::latest()->paginate(10);
        if ($request->post() && $request->search) {
            $categories = Category::where('name', 'like', '%' . $request->search . '%')->paginate(10);
        }
        return view('Admin.Category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Admin.Category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        //
        if ($request->isMethod('POST')) {
            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->slug = Str::slug($request->name);
            $category->save();
            if ($category->save()) {
                return redirect()->route('admin.category.index')->with('category.create.success', 'Create new successfully');
            } else {
                return back()->with('error', 'Something gone wrong');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if ($id) {
            $category = Category::find($id);
            return view('Admin.Category.edit', compact('category'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        if ($request->isMethod('POST')) {
            $category = Category::find($id);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->slug = Str::slug($request->name);
            $category->save();
            if ($category->save()) {
                return redirect()->route('admin.category.index')->with('category.update.success', 'Update successfully');
            } else {
                return back()->with('error', 'Something gone wrong');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id) {
            $category = Category::where('id', $id);
            $category->delete();
            return back()->with('category.destroy.success', 'Delete successfully');
        }
    }

    public function archive(Request $request)
    {
        $categories = Category::onlyTrashed()->paginate(10);
        if ($request->post() && $request->search) {
            $categories = Category::where('name', 'like', '%' . $request->search . '%')->paginate(10);
        }
        return view('Admin.Category.archive', compact('categories'));
    }
    public function remove(string $id)
    {
        if ($id) {
            $category = Category::where('id', $id);
            if ($category->withTrashed()) {
                $category->forceDelete();
                return back()->with('category.remove.success', 'Remove successfully');
            }
        }
    }
    public function restore($id)
    {
        $category = Category::withTrashed()->find($id);
        $category->restore();
        return back()->with('category.restore.success', 'Restore successfully');
    }
}

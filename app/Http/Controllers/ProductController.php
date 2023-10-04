<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $products = Products::latest()->paginate(10);
        if ($request->post() && $request->search) {
            $products = Products::where('name', 'like', '%' . $request->search . '%')->paginate(10);
        }
        return view('Admin.Product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('Admin.Product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //
        if ($request->isMethod('POST')) {
            // dd($request);
            if ($request->hasFile('img')) {
                $img = uploadFile('product_img', $request->file('img'));
            }
            $product = new Products();
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->img = $img;
            $product->save();
            if ($product->save()) {
                return redirect()->route('admin.product.index')->with('product.create.success', 'Product create successfully');
            } else {
                return back()->with('product.create.fail', 'Fail to add new product');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        if ($id) {
            $product = Products::find($id);
            $categories = Category::all();
            return view('Admin.Product.edit', compact('product', 'categories'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('POST')) {
            if ($id) {
                $product = Products::find($id);
                $img = Products::where('id', $id)->select('img')->first()->img;
                if ($request->hasFile('img')) {
                    $oldIMG = Storage::delete('/public/' . $img);
                    if ($oldIMG) {
                        $img = uploadFile('product_img', $request->file('img'));
                    }
                }
                $product->name = $request->name;
                $product->slug = Str::slug($request->name);
                $product->price = $request->price;
                $product->quantity = $request->quantity;
                $product->description = $request->description;
                $product->category_id = $request->category_id;
                $product->img = $img;
                $product->save();
                if ($product->save()) {
                    return redirect()->route('admin.product.index')->with('product.update.success', 'Product update successfully');
                } else {
                    return back()->with('product.update.fail', 'Fail to update product');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id) {
            $product = Products::find($id);
            $product->delete();
            if ($product->delete()) {
                return back()->with('product.destroy.success', 'Product delete success');
            }
        }
    }
    public function archive()
    {
        $products = Products::onlyTrashed()->paginate(10);
        return view('Admin.Product.archive', compact('products'));
    }
    public function restore(string $id)
    {
        $product = Products::withTrashed()->find($id);
        $product->restore();
        return back()->with('product.restore.success', 'Restore successfully');
    }
    public function remove(string $id)
    {
        if ($id) {
            $img = Products::withTrashed()->where('id', $id)->select('img')->first()->img;
            Storage::delete('/public/' . $img);
            $product = Products::where('id', $id);
            if ($product->withTrashed()) {
                $product->forceDelete();
                return back()->with('product.remove.success', 'Product remove success');
            }
        }
    }
}

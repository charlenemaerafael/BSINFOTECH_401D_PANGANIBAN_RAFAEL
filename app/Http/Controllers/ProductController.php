<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index', ['products' => Products::all()]);
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255|unique:products',
            'price' => 'required|numeric|min:0.01',
            'description' => 'required|string',
            'pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $this->uploadImage($request);

        Products::create([
            'pic' => $imagePath,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('product.index')->with('success', 'Product Created Successfully!');
    }

    public function show($id)
    {
        return view('product.show', ['product' => Products::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view('product.edit', ['product' => Products::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_name' => 'sometimes|required|string|max:255|unique:products,product_name,' . $id,
            'price' => 'sometimes|required|numeric|min:0.01',
            'description' => 'sometimes|required|string|max:255',
            'pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Products::findOrFail($id);
        $imagePath = $request->hasFile('pic') ? $this->uploadImage($request, $product->pic) : $product->pic;

        $product->update([
            'pic' => $imagePath,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('product.index')->with('success', 'Product Updated Successfully!');
    }

    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product Deleted Successfully!');
    }

    private function uploadImage(Request $request, $oldImagePath = null)
    {
        if ($request->hasFile('pic')) {
            if ($oldImagePath && file_exists(public_path($oldImagePath))) {
                unlink(public_path($oldImagePath)); // Remove old image if exists
            }
            $file = $request->file('pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            return 'uploads/products/' . $filename;
        }
        return $oldImagePath;
    }
}

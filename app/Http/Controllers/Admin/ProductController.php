<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\MediaService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index(): View
    {
        $products = Product::withSum('stocks', 'quantity')->paginate(12);
        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $products = Product::with('category')->get();

        $categories = Category::all();

        return view('admin.products.create', compact('products', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request['slug'] = Str::slug($request['slug']);
        $data = $request->validate([
            'name'          => ['required'],
            'slug'          => ['required', 'unique:products,slug'],
            'price'         => ['required'],
            'on_sale'       => ['nullable', 'boolean'],
            'sale_price'    => ['nullable'],
            'description'   => ['required'],
            'image'         => ['nullable', 'image', 'mimes:png,jpg,gif'],
            'category_id'   => ['required', 'exists:categories,id'],
        ]);

        unset($data['image']);

        $data['on_sale'] = $request->on_sale ? true : false;

        if ($request->hasFile('image')) {
            $media = (new MediaService)->upload($request->file('image'), 'products');
        }

        Product::create([
            'name'          => $request->name,
            'slug'          => $request->slug,
            'price'         => $request->price,
            'on_sale'       => $request->on_sale,
            'sale_price'    => $request->sale_price,
            'description'   => clean($request->description),
            'media_id'      => $media ?? null,
            'category_id'   => $request->category_id,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product Added Successfully');
    }

    public function show(Product $product): View
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $categories = Category::all();

        return view('admin.products.edit', compact('product',  'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $request['slug'] = Str::slug($request['slug']);

        $data = $request->validate([
            'name'          => ['required'],
            'slug'          => ['required', 'unique:products,slug,' . $product->id],
            'price'         => ['required'],
            'on_sale'       => ['nullable', 'boolean'],
            'sale_price'    => ['nullable'],
            'description'   => ['required'],
            'image'         => ['nullable', 'image', 'mimes:png,jpg,gif'],
            'category_id'   => ['exists:categories,id'],
        ]);

        unset($data['image']);

        $data['on_sale'] = $request->on_sale ? true : false;

        if ($request->hasFile('image')) {
            if ($product->media_id && $product->media) {
                Storage::delete('public/' . $product->media->path);
            }

            $media = (new MediaService)->upload($request->file('image'), 'products');
        }

        $product->update([
            'name'          => $request->name,
            'slug'          => $request->slug,
            'price'         => $request->price,
            'on_sale'       => $request->on_sale,
            'sale_price'    => $request->sale_price,
            'description'   => clean($request->description),
            'media_id'      => $media ?? null,
            'category_id'   => $request->category_id,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product Updated Successfully');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->media_id && $product->media) {
            Storage::delete('public/' . $product->media->path);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product Deleted Successfully');
    }

    public function generateSlug(Request $request): string
    {
        if (empty($request->title)) {
            return "";
        }

        $title = Str::slug($request->title);
        return $this->checkAndGenerateSlug($title, 0);
    }

    public function checkAndGenerateSlug(string $title, int $number = 0): string
    {
        if ($number > 0) {
            $new_title = $title . "-" . $number;
        }

        if (Product::where('slug', $new_title ?? $title)->first()) {
            return $this->checkAndGenerateSlug($title, $number + 1);
        }

        return $new_title ?? $title;
    }
}

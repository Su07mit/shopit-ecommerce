<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function index(): View
    {
        $products = Product::with('media')->take(20)->get();
        $sliders = Slider::with('media')->get();
        $users = User::all();
        return view('frontend.index', compact('products', 'sliders', 'users'));
    }
    // Loads product description page
    public function product(Product $product)
    {
        return view('frontend.product', compact('product'));
    }
    //Authorization 
    public function home(): RedirectResponse
    {
        if (auth()->user()->role == "Admin") {
            return redirect('/admin');
        }
        return redirect('/');
    }

    // Search
    public function search(Request $request, Product $product)
    {
        $search_text = $_GET['search'];
        $products = Product::where('name', 'LIKE', '%' . $search_text . '%')->get();
        return view('frontend.searchproduct', compact('products'));
    }

    // Cart logic

    public function cart()
    {
        $brand_name = "ShopIt";
        $products = Product::all();
        return view('frontend.cart', compact('brand_name', 'products'));
    }

    public function addToCart(Product $product)
    {

        $product = Product::findOrFail($product->id);

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                // "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart')->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {

        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    // Cart Logic Ends

    public function addToWishlish(Product $product)
    {
    }
}

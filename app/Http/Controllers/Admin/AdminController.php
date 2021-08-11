<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        $products = Product::paginate(5);
        $categories = Category::all();
        $orders = Order::paginate(5);
        return view('admin.index', compact('users', 'products', 'categories', 'orders'));
    }
}

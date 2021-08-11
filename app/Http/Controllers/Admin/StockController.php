<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::paginate(12);
        return view('admin.stocks.index', compact('stocks'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.stocks.create', compact('products'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id'    => ['required'],
            'quantity'      => ['integer'],
        ]);

        Stock::create($data);

        return redirect()->route('admin.stocks.index')->with('success', 'Stocks Added Successfully !');
    }
}

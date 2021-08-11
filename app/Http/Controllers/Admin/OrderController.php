<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    protected $payment_methods = [
        'Cash on delivery',
        'e-Sewa',
    ];

    protected $status = [
        'Pending', 'Confirmed', 'Cancelled', 'Delivering', 'Completed', 'Return', 'Refund',
    ];

    public function index(): View
    {
        $orders = Order::with(['user', 'products'])->paginate(12);

        return view('admin.orders.index', compact('orders'));
    }

    public function create(): View
    {
        $payment_methods = $this->payment_methods;
        // $status = Order::STATUS;
        $status = $this->status;
        $products = Product::all();

        $users = User::all();

        return view('admin.orders.create', compact('payment_methods', 'status', 'users', 'products'));
    }

    public function store(Request $request): RedirectResponse
    {

        $data = $request->validate([
            'user_id'           => ['required', 'exists:users,id'],
            'shipping_name'     => ['required'],
            'shipping_address'  => ['required'],
            'shipping_city'     => ['required'],
            'shipping_street'   => ['required'],
            'shipping_phone'    => ['required'],
            'billing_name'      => ['required'],
            'billing_address'   => ['required'],
            'billing_city'      => ['required'],
            'billing_street'    => ['required'],
            'billing_phone'     => ['required'],
            'payment_method'    => ['required', Rule::in($this->payment_methods)],
            'subtotal'          => ['required'],
            'discount'          => ['nullable'],
            'total'             => ['required'],
        ]);

        Order::create($data);

        return redirect()->route('admin.orders.index')->with('success', 'Order Recieved Successfully ');
    }

    public function show(Order $order): View
    {
        $status = $this->status;
        $products = Product::all();

        // $total = 0;

        // foreach ($order->products as $item) {
        //     $total = $total + ($item->pivot->unit_price * $item->pivot->quantity);
        // }

        return view('admin.orders.show', compact('order', 'status', 'products'));
    }

    public function edit(Order $order): View
    {
        $payment_methods = $this->payment_methods;
        $status = $this->status;

        $products = Product::all();
        $users = User::all();

        return view('admin.orders.edit', compact('order', 'payment_methods', 'status', 'users', 'products'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        // $status = Order::STATUS;

        $data = $request->validate([
            'user_id'           => ['required', 'exists:users,id'],
            'shipping_name'     => ['required'],
            'shipping_address'  => ['required'],
            'shipping_city'     => ['required'],
            'shipping_street'   => ['required'],
            'shipping_phone'    => ['required'],
            'billing_name'      => ['required'],
            'billing_address'   => ['required'],
            'billing_city'      => ['required'],
            'billing_street'    => ['required'],
            'billing_phone'     => ['required'],
            'payment_method'    => ['required', Rule::in($this->payment_methods)],
            'subtotal'          => ['required'],
            'discount'          => ['nullable'],
            'total'             => ['required'],
            'status'            => ['required', Rule::in($this->status)],
            'remarks'           => ['nullable'],
        ]);

        $order->update($data);

        return redirect()->route('admin.orders.index')->with('success', 'Order Updated Successfully ');
    }

    public function UpdateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status'    =>  ['required', Rule::in($this->status)],
        ]);

        $order->update($data);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Status Updated Successfully');
    }

    public function AddProduct(Request $request, Order $order)
    {
        $data = $request->validate([
            'product_id'    =>  ['required', 'exists:products,id'],
            'quantity'      =>  ['required', 'integer', 'min:0'],
        ]);

        $product = Product::find($request->product_id);
        $price = $product->on_sale ? $product->sale_price : $product->price;

        $quantityCheck = OrderProduct::where('product_id', $request->product_id)

            ->where('order_id', $order->id)
            ->first();

        if ($quantityCheck) {
            $quantityCheck->update(['quantity' => $quantityCheck->quantity + $request->quantity]);
        } else {
            OrderProduct::create([
                'order_id'      =>  $order->id,
                'product_id'    =>  $request->product_id,
                'quantity'      =>  $request->quantity,
                'unit_price'    =>  $price,
            ]);
        }

        return redirect()->route('admin.orders.show', $order)->with('success', 'Product Added To Order Successfully');
    }

    public function removeProduct(Request $request, Order $order)
    {
        $request->validate([
            'order_product_id'  =>  ['required', 'exists:order_product,id'],
        ]);

        $orderproduct = OrderProduct::find($request->order_product_id);

        if ($orderproduct->order_id != $order->id) {
            return redirect()->route('admin.orders.show', $order)->with('error', 'Product could not be removed as it belongs to another order');
        }

        $orderproduct->delete();

        return redirect()->route('admin.orders.show', $order)->with('success', 'Product Removed From The Order Successfully');
    }

    public function editQuantity(Order $order, $orderid)
    {
        $orderproduct = OrderProduct::findOrFail($orderid);
        return view('admin.orders.quantity', compact('order', 'orderproduct'));
    }

    public function updateQuantity(Request $request, Order $order, $orderid)
    {
        $orderproduct = OrderProduct::findOrFail($orderid);

        $data = $request->validate([
            'quantity'   =>  ['required', 'integer', 'min:0'],
        ]);

        $orderproduct->update($data);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Product Quantity Updated Successfully');
    }
}

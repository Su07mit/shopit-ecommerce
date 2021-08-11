<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::with(['user', 'product'])->all();
        return redirect()->back(compact('carts'));
    }

    public function create()
    {
        $users = User::all();
        return redirect()->back(compact('users'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'           => ['required', 'exists:users,id'],

        ]);

        Cart::create($data);
    }


    public function show(Cart $cart)
    {
        return view('frontend.cart', compact('cart'));
    }

    public function edit(Cart $cart)
    {
        $users = User::all();
        return view('frontend.cart', compact('users', 'order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CouponController extends Controller
{

    public function index(): View
    {
        $coupons = Coupon::paginate(12);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create(): View
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'code'              => ['required', 'unique:coupons,code'],
            'amount'            => ['nullable'],
            'is_amount'         => ['nullable', 'boolean'],
            'min_bill_amount'   => ['required'],
            'max_discount'      => ['required'],
            'is_onetime'        => ['nullable', 'boolean'],
            'start_date'        => ['required'],
            'end_date'          => ['required'],
            'first_order_only'  => ['nullable', 'boolean'],
            'description'       => ['nullable'],

        ]);

        $data['is_amount'] = $request->is_amount ? true : false;

        $data['is_onetime'] = $request->is_onetime ? true : false;

        $data['first_order_only'] = $request->first_order_only ? true : false;

        Coupon::create([
            'code'              =>  $request->code,
            'amount'            =>  $request->amount,
            'is_amount'         =>  $request->is_amount,
            'min_bill_amount'   =>  $request->min_bill_amount,
            'max_discount'      =>  $request->max_discount,
            'is_onetime'        =>  $request->is_onetime,
            'start_date'        =>  $request->start_date,
            'end_date'          =>  $request->end_date,
            'first_order_only'  =>  $request->first_order_only,
            'description'       =>  clean($request->description),
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon Code Added Successfully');
    }

    public function show(Coupon $coupon): View
    {
        return view('admin.coupons.show');
    }


    public function edit(Coupon $coupon): View
    {
        return view('admin.coupons.edit', compact('coupon'));
    }


    public function update(Request $request, Coupon $coupon): RedirectResponse
    {
        $data = $request->validate([
            'code'              => ['required', 'unique:coupons,code'],
            'amount'            => ['nullable'],
            'is_amount'         => ['nullable', 'boolean'],
            'min_bill_amount'   => ['required'],
            'max_discount'      => ['required'],
            'is_onetime'        => ['nullable', 'boolean'],
            'start_date'        => ['required'],
            'end_date'          => ['required'],
            'first_order_only'  => ['nullable', 'boolean'],
            'description'       => ['nullable'],

        ]);

        $data['is_amount'] = $request->is_amount ? true : false;

        $data['is_onetime'] = $request->is_onetime ? true : false;

        $data['first_order_only'] = $request->first_order_only ? true : false;

        $coupon->update([
            'code'              =>  $request->code,
            'amount'            =>  $request->amount,
            'is_amount'         =>  $request->is_amount,
            'min_bill_amount'   =>  $request->min_bill_amount,
            'max_discount'      =>  $request->max_discount,
            'is_onetime'        =>  $request->is_onetime,
            'start_date'        =>  $request->start_date,
            'end_date'          =>  $request->end_date,
            'first_order_only'  =>  $request->first_order_only,
            'description'       =>  clean($request->description),
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon Code Updated Successfully');
    }

    public function destroy(Coupon $coupon): RedirectResponse
    {
        $coupon->delete();

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon Code Deleted Successfully');
    }
}

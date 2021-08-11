@extends('adminlte::page')

@section('title','Create Order')

@section('content')

<x-alert/>

<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5;">
            Edit Order
        </h3>

        <div class="card-tools">
            <a href="{{ route('admin.orders.index') }}" class="btn-sm btn-primary">
                Show All Orders
            </a>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.orders.update', $order) }}" enctype="multipart/form-data" >

            @csrf

            @method('PUT')

        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control @error('user_id')
                is invalid
            @enderror">

            <option value="">Select a User...</option>

                @foreach ($users as $user )
                    <option 
                    value="{{ $user->id }}"
                    @if ( $order->user_id == $user->id )
                        selected
                    @endif>
                    {{ $user->name }}
                    </option>
                    @error('user_id')
                    <small class="form-text text-danger">
                    {{ $message }}
                    </small>
                    @enderror
                @endforeach
            </select>
            @error('user_id')
                <small class="form-text text-danger">
                {{ $message }}
                </small>
            @enderror
        </div>

        {{-- <div class="form-group">
            <label for="product_id">Product</label>
            <select name="product_id" id="product_id" class="form-control @error('product_id')
                is invalid
            @enderror">
        <option value="">Select a Product...</option>

                @foreach ($products as $product )
                    <option 
                    value="{{ $product->id }}"
                    @if ( $order->product_id == $product->id )
                        selected
                    @endif>
                    {{ $product->name }}
                    </option>
                    @error('product_id')
                    <small class="form-text text-danger">
                    {{ $message }}
                    </small>
                    @enderror
                @endforeach
            </select>
            @error('product_id')
                <small class="form-text text-danger">
                {{ $message }}
                </small>
            @enderror
        </div> --}}

        <x-input
        field="shipping_name"
        text="Enter Shipping Name"
        :current="$order->shipping_name"
        />

         <x-input
        field="shipping_address"
        text="Enter Shipping Address"
        :current="$order->shipping_address"
        />

        <x-input
        field="shipping_city"
        text="Enter Shipping City"
        :current="$order->shipping_city"
        />

        <x-input
        field="shipping_street"
        text="Enter Shipping Street"
        :current="$order->shipping_street"
        />

         <x-input
        field="shipping_phone"
        text="Enter Shipping Phone Number"
        type="number"
        :current="$order->shipping_phone"
        />

        <x-input
        field="billing_name"
        text="Enter Billing Name"
        :current="$order->billing_name"
        />

        <x-input
        field="billing_address"
        text="Enter Billing Address"
        :current="$order->billing_address"
        />

        <x-input
        field="billing_city"
        text="Enter Billing City"
        :current="$order->billing_city"
        />

        <x-input
        field="billing_street"
        text="Enter Billing Street"
        :current="$order->billing_street"
        />

         <x-input
        field="billing_phone"
        text="Enter Billing Phone Number"
        type="number"
        :current="$order->billing_phone"
        />


        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select name="payment_method" id="payment_method" class="form-control 
            @error('payment_method')
                is invalid
            @enderror">
                <option value="payment_method">Select the payment method...</option>
                @foreach ($payment_methods as $payment_method )
                    <option 
                    value="{{ $payment_method }}"
                    @if ( $order->payment_method == $payment_method )
                        selected
                    @endif>
                    {{ $payment_method }}
                    </option>
                @endforeach
            </select>
            @error('payment_method')
                <small class="form-text text-danger">
                {{ $message }}
                </small>
            @enderror
        </div>
        
        <x-input
        field="subtotal"
        text="Subtotal"
        type="number"
        :current="$order->subtotal"
        />

        <x-input
        field="discount"
        text="Discount"
        type="number"
        :current="$order->discount"
        />

        <x-input
        field="total"
        text="Total"
        type="number"
        :current="$order->total"
        />

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control @error('status')
                is invalid
            @enderror">
            <option value="status">What is the status of the order ?</option>
                @foreach ($status as $stat )
                    <option 
                    value="{{ $stat }}"
                    @if ( $order->status == $stat )
                        selected
                    @endif>
                    {{ $stat }}
                    </option>
                @endforeach
            </select>
            @error('status')
                <small class="form-text text-danger">
                {{ $message }}
                </small>
            @enderror
        </div>

        <x-input
        field="remarks"
        text="Remarks"
        type="textarea"
        :current="$order->remarks"
        />

        <button type="submit" class="btn-sm btn-primary">
            <i class="fas fa-fw fa-save mr-2"></i>
            <span>Save</span>
        </button>
        </form>
    </div>
</div>
@endsection
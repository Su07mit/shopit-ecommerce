@extends('adminlte::page')

@section('title','Order Details')

@section('content')

<x-alert/>

<x-delete/>

<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5;">
            Order Details
        </h3>

        <div class="card-tools">
             <form action="{{ route('admin.orders.status', $order )}}" method="POST" style="display: inline-block" class="mr-4">

                @csrf

                <div class="input-group">
                    <select name="status" id="status" class="form-control" style="min-width: 150px">
                        @foreach ($status as $stat )
                            <option value="{{ $stat }}" 
                                @if ($order->status == $stat)
                                    selected
                                @endif>
                                {{ $stat }}
                            </option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-info" type="submit" id="button-addon2">Update Status</button>
                    </div>
                </div>
            </form>

            <a href="{{ route('admin.orders.index') }}" class="btn-sm btn-primary">
                <i class="fas fa-fw fa-arrow-left mr-1"></i>
                <span>Show All Orders</span>
            </a>
        </div>
    </div>
    
    <div class="card-body p-0">
        <table class="table table-bordered">
            <tr>
                <th style="width: 15%;">Order ID</th>
                <td>{{ $order->id }}</td>
            </tr>

            <tr>
                <th>User Name</th>
                <td>
                    @if ($order->user_id)
                        <a href="{{ route('admin.users.show',$order->user_id)}}">
                        {{ $order->user->name }}
                        </a>
                    @endif
                </td>
            </tr>
            
        </table>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.orders.products', $order) }}" method="POST" enctype="multipart/form-data">
             @csrf

            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="form-group">
                        <label for="product_id">Product</label>
                        <select name="product_id" id="product_id" class="form-control @error('product_id')
                            is invalid
                        @enderror">
                            <option value="">Select a Product...</option>

                            @foreach ($products as $product )
                                <option 
                                value="{{ $product->id }}"
                                @if ( old('product_id') == $product->id )
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
                    </div>
                </div>

                <div class="col-12-col-md-2 mr-4">
                    <x-input
                    field="quantity"
                    text="Quantity"
                    type="number"
                    :current="old('quantity') ?? 1"
                    />
                </div>

                <div class="col-12-col-md-2 pt-2">
                    <button type="submit" class="btn-sm btn-primary mt-4">
                        <i class="fas fa-fw fa-save mr-2"></i>
                        <span>Save</span>
                    </button>
                </div>
            </div>
            
        </form>
    </div>

    <div class="card-body p-0">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                {{-- @dd($order) --}}
                @foreach ($order->products as $item )
                    <tr>
                        <td>{{ $loop->index +1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->pivot->quantity }}</td>
                        <td>Rs. {{ $item->pivot->unit_price }}</td>
                        <td>Rs. {{ $item->pivot->unit_price * $item->pivot->quantity }}</td>
                        <td>
                            <a href="{{ route('admin.orders.quantity.edit', [$order, $item->pivot->id])}}" class="btn btn-sm btn-primary">Edit</a>

                            <a href="#!" onclick="confirmDelete({{ $item->pivot->id }})" class="btn btn-sm btn-danger">Delete</a>

                            <form id="delete-form-{{ $item->pivot->id }}" action="{{ route('admin.orders.removeProducts', $order) }}" method="POST">
                                @csrf @method('DELETE')
                                <input type="hidden" name="order_product_id" value="{{ $item->pivot->id }}">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

            <tr>
                <th colspan="4" style="text-align: right">Total</th>
                <td><b>Rs. {{ $order->total }}</b></td>
                <td></td>
            </tr>
        </table>
    </div>

    <div class="card-body p-0">
        <table class="table table-bordered">
            <tr>
                <th style="width: 15%;">Shipping To </th>
                <td>{{ $order->shipping_name }}</td>
            </tr>
            
            <tr>
                <th>Shipping Address </th>
                <td>{{ $order->shipping_address }}</td>
            </tr>

            <tr>
                <th>Shipping City </th>
                <td>{{ $order->shipping_city }}</td>
            </tr>

            <tr>
                <th>Shipping Street </th>
                <td>{{ $order->shipping_street }}</td>
            </tr>

            <tr>
                <th>Shipping Phone Number</th>
                <td>{{ $order->shipping_phone }}</td>
            </tr>

            <tr>
                <th>Billed To </th>
                <td>{{ $order->billing_name }}</td>
            </tr>

            <tr>
                <th>Billing Address </th>
                <td>{{ $order->billing_address }}</td>
            </tr>

            <tr>
                <th>Billing City </th>
                <td>{{ $order->billing_city }}</td>
            </tr>

            <tr>
                <th>Billing Street </th>
                <td>{{ $order->billing_street }}</td>
            </tr>

            <tr>
                <th>Billing City </th>
                <td>{{ $order->billing_city }}</td>
            </tr>

            <tr>
                <th>Billing Phone Number </th>
                <td>{{ $order->billing_phone }}</td>
            </tr>

            <tr>
                <th>Payment Method</th>
                <td>{{ $order->payment_method }}</td>
            </tr>
            
            <tr>
                <th>Subtotal</th>
                <td>{{ $order->subtotal }}</td>
            </tr>

            <tr>
                <th>Discount</th>
                <td>{{ $order->discount}}</td>
            </tr>

            <tr>
                <th>Total Amount</th>
                <td><b>Rs. {{ $order->total }}</b></td>
            </tr>

            <tr>
                <th>Customer Remarks</th>
                <td>{{ $order->remarks }}</td>
            </tr>

            <tr>
                <th>Placed</th>
                <td>{{ $order-> created_at }}</td>
            </tr>

            <tr>
                <th>Updated</th>
                <td>{{ $order-> updated_at }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection
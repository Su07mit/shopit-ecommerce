@extends('adminlte::page')

@section('title','Update Quantity')

@section('content')

<x-alert/>

<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5;">
            Update Quantity
        </h3>

        <div class="card-tools">
            <a href="{{ route('admin.orders.show', $order) }}" class="btn-sm btn-primary">
                <i class="fas fa-fw fa-arrow-left mr-1"></i>
                <span>Show Order</span>
            </a>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.orders.quantity.update',[$order->id,$orderproduct->id]) }}" enctype="multipart/form-data" >

            @csrf

            <div class="form-group">
                <label for="product">Product</label>
                <input type="text" class="form-control" value="{{ $orderproduct->product->name }}" disabled>
            </div>

            <x-input
            field="quantity"
            type="number"
            text="Quantity"
            :current="$orderproduct->quantity"
            />


        <button type="submit" class="btn-sm btn-primary">
            <i class="fas fa-fw fa-save mr-2"></i>
            <span>Save</span>
        </button>
        </form>
    </div>
</div>
@endsection
@extends('adminlte::page')

@section('title','Add Coupon')

@section('content')

<x-alert/>

<x-editor field="description"/>

<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5;">
            Add New Coupon Code
        </h3>

        <div class="card-tools">
            <a href="{{ route('admin.coupons.index') }}" class="btn-sm btn-primary">
                Show All Coupon Codes
            </a>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.coupons.store') }}" enctype="multipart/form-data" >

            @csrf

        <x-input
        field="code"
        text="Coupon Code"
        />

        <x-input
        field="amount"
        text="Amount"
        type="number"
        />


        <div class="form-group">
            <label for="is_amount">Is the discount price in amount? (If not checked, the discount is in percentage )</label> <br>

            <div class="icheck-primary">
                <input type="checkbox" id="is_amount" name="is_amount" value="1" 
                @if (old('is_amount') )
                    checked    
                @endif>
                <label for="is_amount">Yes</label> <br>
            </div>

            @error('is_amount')
                <small class="form-text text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <x-input
        field="min_bill_amount"
        text="Minimun Bill Amount"
        type="number"
        />

        <x-input
        field="max_discount"
        text="Max Discount"
        type="number"
        />

        <div class="form-group">
            <label for="is_onetime">Is the coupon code usable one time only?</label> <br>

            <div class="icheck-primary">
                <input type="checkbox" id="is_onetime" name="is_onetime" value="1" 
                @if (old('is_amount') )
                    checked    
                @endif>
                <label for="is_onetime">Yes</label> <br>
            </div>

            @error('is_onetime')
                <small class="form-text text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <x-input
        field="start_date"
        text="Valid From"
        type="date"
        />

        <x-input
        field="end_date"
        text="End On"
        type="date"
        />

        <div class="form-group">
            <label for="first_order_only">Is the coupon code usable for first order only?</label> <br>

            <div class="icheck-primary">
                <input type="checkbox" id="first_order_only" name="first_order_only" value="1" 
                @if (old('is_amount') )
                    checked    
                @endif>
                <label for="first_order_only">Yes</label> <br>
            </div>

            @error('first_order_only')
                <small class="form-text text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <x-input
        field="description"
        text="Coupon Code Details"
        type="textarea"
        />

        <button type="submit" class="btn-sm btn-primary">
            <i class="fas fa-fw fa-save mr-2"></i>
            <span>Save</span>
        </button>
        </form>
    </div>
</div>
@endsection
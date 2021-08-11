@extends('adminlte::page')

@section('title','Add Stock')

@section('content')

<x-alert/>

<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5;">
            Add Stock
        </h3>

        <div class="card-tools">
            <a href="{{ route('admin.stocks.index') }}" class="btn-sm btn-primary">
                Show All Stocks
            </a>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.stocks.store') }}" enctype="multipart/form-data" >

            @csrf

        <div class="form-group">
            <label for="product_id">Product</label>
            <select name="product_id" id="product_id" class="form-control @error('product_id')
                is invalid
            @enderror">

            <option value="">Select a product...</option>

                @foreach ($products as $product )
                    <option 
                    value="{{ $product->id }}"
                    @if ( old('product_id') == $product->id )
                        selected
                    @endif>
                    {{ $product->name }}
                    </option>
                @endforeach
            </select>

            @error('product_id')
                <small class="form-text text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <x-input
        field="quantity"
        text="Quantity"
        type="number"
        />

        <button type="submit" class="btn-sm btn-primary">
            <i class="fas fa-fw fa-save mr-2"></i>
            <span>Save</span>
        </button>
        </form>
    </div>
</div>
@endsection
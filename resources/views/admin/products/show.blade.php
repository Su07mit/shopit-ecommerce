@extends('adminlte::page')

@section('title','Product Details')

@section('content')

<x-alert/>

<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5;">
            product Details
        </h3>

        <div class="card-tools">
            <a href="{{ route('admin.products.index') }}" class="btn-sm btn-primary">
                Show All Products
            </a>
        </div>
    </div>
    
    <div class="card-body p-0">
        <table class="table">
            <tr>
                <th style="width: 15%;">ID</th>
                <td>{{ $product->id }}</td>
            </tr>

            @if ($product->image)
            <tr>
                <th>Product Picture</th>
                <td>                   
                    <img src="{{ $product->image }}" height="160px" alt="Product Picture">                                                        
                </td>
            </tr>
            @endif 

            <tr>
                <th>Name</th>
                <td>{{ $product->name }}</td>
            </tr>

            <tr>
                <th>Slug</th>
                <td>{{ $product->slug }}</td>
            </tr>

            <tr>
                <th>Price</th>
                <td>{{ $product->price }}</td>
            </tr>

            <tr>
                <th>On Sale ?</th>
                @if ($product->on_sale)
                    <td>Yes</td>
                @else
                    <td>No</td>    
                @endif
            </tr>

            @if ($product->on_sale)
            <tr>
                <th>Sale Price</th>
                <td>{{ $product->sale_price }}</td>
            </tr>
            @endif

            <tr>
                <th>Category</th>
                <td>
                    @if ($product->category_id)
                        <a href="{{ route('admin.categories.show',$product->category_id)}}">
                            {{ $product->category->name }}
                        </a>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{!! $product->description !!}</td>
            </tr>
            
            <tr>
                <th>Created</th>
                <td>{{ $product-> created_at }}</td>
            </tr>
            
        </table>
    </div>
</div>
@endsection
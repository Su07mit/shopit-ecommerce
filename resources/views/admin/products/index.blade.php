@extends('adminlte::page')

@section('title', 'Product List')

@section('content')

<x-alert/>
<x-delete/>

    <div class="card">
        <div class="card-header">

            <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5">Products</h3>
            <div class="card-tools">
              <a href="{{route('admin.products.create')}}" class="btn-sm btn-primary" >Add New Product</a>
            </div>
            
        </div>
        <div class="card-body p-0">

            @if (count($products) > 0)              
           
            <table class="table table-bordered table-striped">
                <thead class="thead-dark bg-info">
                    <tr>
                        <td>ID</td>
                        <td>Product Name</td>
                        <td>Slug</td>
                        <td>Price</td>
                        <td>On Sale</td>
                        <td>Category</td>
                        <td>Stock</td>
                        <td style="width:300px;">Actions</td>
                    </tr>
                </thead>

                <tbody>
                    
                    @foreach ($products as $product )

                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->slug }}</td>
                        <td>{{ $product->price }}</td>
                        
                        @if ($product->on_sale)
                            <td>Yes</td>
                        @else
                        <td>No</td>    
                        @endif
                        
                        <td>
                            @if ($product->category_id)
                                <a href="{{ route('admin.categories.show', $product->category_id) }}">{{ $product->category->name }}</a>
                            @endif                            
                        </td>

                        <td>                           
                            {{ $product->stocks->sum('quantity') }}                          
                        </td>

                        <td>
                            <a 
                                href="{{ route('admin.products.show', $product->id) }}" 
                                class="btn-sm btn-primary mr-2">
                                Show Details
                            </a>

                            <a 
                                href="{{ route('admin.products.edit', $product->id) }}" 
                                class="btn-sm btn-secondary mr-2">
                                Edit product
                            </a>
                            
                            <a href="#" onclick="confirmDelete({{ $product->id }})" class="btn-sm btn-danger" > Delete 
                            </a>

                            <form id="delete-form-{{ $product->id }}" action="{{ route('admin.products.destroy', $product) }}" method="POST">

                            @csrf    
                            @method('DELETE')

                            </form>
                            
                        </td>
                    </tr>
                    
                    @endforeach
                    
                </tbody>
            </table>
            
            @else

            <div class="alert alert-warning mb-0 text-center">
                No more products available !
            </div>

            @endif
            
        </div>
        @if ($products->perpage() < $products->total() )
            <div class="card-footer">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection

@extends('adminlte::page')

@section('title', 'Product Stocks')

@section('content')

<x-alert/>
<x-delete/>

    <div class="card">
        <div class="card-header">

            <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5">Stock</h3>
            <div class="card-tools">
              <a href="{{route('admin.stocks.create')}}" class="btn-sm btn-primary" >Add Stocks</a>
            </div>
            
        </div>
        <div class="card-body p-0">

            @if (count($stocks) > 0)              
           
            <table class="table table-bordered table-striped">
                <thead class="thead-dark bg-info">
                    <tr>
                        <td>Product ID</td>
                        <td>Product Name</td>
                        <td>Quantity</td>
                    </tr>
                </thead>

                <tbody>
                    
                    @foreach ($stocks as $stock )

                    <tr>
                        <td>{{ $stock->product_id }}</td>

                        <td>
                            @if ($stock->product_id)
                                <a href="{{ route('admin.products.show',$stock->product_id)}}">
                                    {{ $stock->product->name }}
                                </a>
                            @endif    
                        </td>

                        <td>{{ $stock->quantity }}</td>
                    </tr>
                    
                    @endforeach
                    
                </tbody>
            </table>
            
            @else

            <div class="alert alert-warning mb-0 text-center">
                No more stocks available !
            </div>

            @endif
            
        </div>
        @if ($stocks->perpage() < $stocks->total() )
            <div class="card-footer">
                {{ $stocks->links() }}
            </div>
        @endif
    </div>
@endsection

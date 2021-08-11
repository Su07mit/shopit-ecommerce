@extends('adminlte::page')

@section('title', 'Orders List')

@section('content')

<x-alert/>

    <div class="card">
        <div class="card-header">

            <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5">Orders</h3>
            <div class="card-tools">
              <a href="{{route('admin.orders.create')}}" class="btn-sm btn-primary" >Add Order</a>
            </div>
            
        </div>
        <div class="card-body p-0">

            @if (count($orders) > 0)              
           
            <table class="table table-bordered table-striped">
                <thead class="thead-dark bg-info">
                    <tr>
                        <td>ID</td>
                        <td>User Name</td>
                        <td>Total Amount</td>
                        <td>Status</td>
                        <td>Total Amount</td>
                        <td>Remarks</td>
                        <td>Actions</td>
                    </tr>
                </thead>

                <tbody>
                    
                    @foreach ($orders as $order )

                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                                <a href="{{ route('admin.users.show',$order->user_id)}}">
                                {{ $order->user->name }}
                                </a>
                        </td>
                        {{-- <td>
                            @if ($order->product_id)
                                <a href="{{ route('admin.products.show',$order->product_id)}}">
                                {{ $order->products->name }}
                                </a>
                            @endif
                        </td> --}}
                        <td>{{ $order->total }}</td>
                        <td>{{ $order->status }}</td>
                        <td>Rs. {{ $order->total }}</td>
                        <td>{{ $order->remarks}}</td>
                        <td>
                            <a 
                                href="{{ route('admin.orders.show', $order->id) }}" 
                                class="btn-sm btn-primary mr-2">
                                Show Details
                            </a>

                            <a 
                                href="{{ route('admin.orders.edit', $order->id) }}" 
                                class="btn-sm btn-secondary mr-2">
                                Edit order
                            </a>                                                
                        </td>
                    </tr>
                    
                    @endforeach
                    
                </tbody>
            </table>
            
            @else

            <div class="alert alert-warning mb-0 text-center">
                No more orders available !
            </div>

            @endif
            
        </div>
        @if ($orders->perpage() < $orders->total() )
            <div class="card-footer">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection

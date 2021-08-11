@extends('layouts.app')
@section('content')
<x-delete/>
<div class="container">
    <h1 class="text-center">Cart</h1>
    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="50%">Product</th>
                    <th width="10%">Price</th>
                    <th width="80%">Quantity</th>
                    <th width="22%">Sub Total</th>
                </tr>
            </thead>
            <tbody>
               @php $total=0; @endphp
               @if (session('cart'))
                    @foreach (session('cart') as $id => $product )
                    @php
                        $sub_total = $product['price']*$product['quantity']; 
                        $total += $sub_total;
                    @endphp
                        <tr> 
                            <td>
                                {{-- @if ($product->image)
                                <img src="{{ $product->image }}" alt="Product Picture" style="max-width: 100%">
                                @endif  --}}
                                <span>{{ $product['name'] }}</span>
                            </td>

                            <td>{{ $product['price'] }}</td>

                            <td>{{ $product['quantity'] }}</td>

                            <td>{{ $sub_total }}</td>

                             <form action="{{ route('remove.from.cart',[$id]) }}">
                                @csrf
                                @method('DELETE')

                            <td>
                                <a href="" class="btn btn-danger btn-sm">X</a>
                            </td>
                            </form>
                            
                            
                        </tr>
                    @endforeach    
               @endif
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <a href="{{ route('index' )}}" class="btn btn-warning">Continue Shopping</a>
                    </td>
                    <td colspan="2"></td>
                    <td><strong>Total {{$total}}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
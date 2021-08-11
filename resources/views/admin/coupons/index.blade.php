@extends('adminlte::page')

@section('title', 'Coupon Codes')

@section('content')

<x-alert/>
<x-delete/>

    <div class="card">
        <div class="card-header">

            <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5">Coupon Codes</h3>
            <div class="card-tools">
              <a href="{{route('admin.coupons.create')}}" class="btn-sm btn-primary" >Add coupons</a>
            </div>
            
        </div>
        <div class="card-body p-0">

            @if (count($coupons) > 0)              
           
            <table class="table table-bordered table-striped">
                <thead class="thead-dark bg-info">
                    <tr>
                        <td>ID</td>
                        <td>Coupon Code</td>
                        <td>Amount</td>
                        <td>One Time Coupon?</td>
                        <td>Start Date</td>
                        <td>End Date</td>
                        <td>First Order Only?</td>
                        <td>Actions</td>
                    </tr>
                </thead>

                <tbody>
                    
                    @foreach ($coupons as $coupon )

                    <tr>
                        <td>{{ $coupon->id }}</td>

                        <td>{{ $coupon->code }}</td>

                        <td>{{ $coupon->amount }}</td>

                        @if ($coupon->is_onetime)
                            <td>Yes</td>
                            @else
                            <td>No</td>
                        @endif
                        

                        <td>{{ $coupon->start_date }}</td>

                        <td>{{ $coupon->end_date }}</td>

                        @if ($coupon->first_order_only)
                            <td>Yes</td>
                            @else
                            <td>No</td>
                        @endif
                        
                        <td>

                            <a 
                                href="{{ route('admin.coupons.edit', $coupon->id) }}" 
                                class="btn-sm btn-secondary mr-2">
                                Edit coupon
                            </a>
                            
                            <a href="#" onclick="confirmDelete({{ $coupon->id }})" class="btn-sm btn-danger" > Delete 
                            </a>

                            <form id="delete-form-{{ $coupon->id }}" action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST">

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
                No more coupons available !
            </div>

            @endif
            
        </div>
        @if ($coupons->perpage() < $coupons->total() )
            <div class="card-footer">
                {{ $coupons->links() }}
            </div>
        @endif
    </div>
@endsection

@extends('adminlte::page')

@section('title', 'Product attributes')

@section('content')

<x-alert/>
<x-delete/>

    <div class="card">
        <div class="card-header">

            <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5">Product Attributes</h3>
            <div class="card-tools">
              <a href="{{route('admin.attributes.create')}}" class="btn-sm btn-primary" >Add attributes</a>
            </div>
            
        </div>
        <div class="card-body p-0">

            @if (count($attributes) > 0)              
           
            <table class="table table-bordered table-striped">
                <thead class="thead-dark bg-info">
                    <tr>
                        <td>ID</td>
                        <td>Attribute Name</td>
                        <td>Description</td>
                        <td>Actions</td>
                    </tr>
                </thead>

                <tbody>
                    
                    @foreach ($attributes as $attribute )

                    <tr>
                        <td>{{ $attribute->id }}</td>

                        <td>{{ $attribute->name }}</td>

                        <td>{{ strip_tags($attribute->description) }}</td>

                        <td>

                            <a 
                                href="{{ route('admin.attributes.edit', $attribute->id) }}" 
                                class="btn-sm btn-secondary mr-2">
                                Edit Attribute
                            </a>
                            
                            <a href="#" onclick="confirmDelete({{ $attribute->id }})" class="btn-sm btn-danger" > Delete 
                            </a>

                            <form id="delete-form-{{ $attribute->id }}" action="{{ route('admin.attributes.destroy', $attribute) }}" method="POST">

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
                No more attributes available !
            </div>

            @endif
            
        </div>
        @if ($attributes->perpage() < $attributes->total() )
            <div class="card-footer">
                {{ $attributes->links() }}
            </div>
        @endif
    </div>
@endsection

@extends('adminlte::page')

@section('title','Add Product')

@push('js')
    <script>

        $('#name').keyup(function() {

            let title = document.getElementById('name').value;

            if (title == ''){
                $('#slug-suggestion').hide();
                return;
            }

            $.ajax({

                url: "{{ route('admin.products.slug') }}",
                data: { title: title },

                success: function(result){

                $('#slug-suggestion').slideDown();
                $('#slug-value').text(result);
                
                }
            });

        });

        $('#slug-value').on('click', function(e){
            e.preventDefault();

            $('#slug').val($('#slug-value').text());
        });
        
    </script>
@endpush

@section('content')

<x-alert/>
<x-editor field="description"/>

<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5;">
            Add New Product
        </h3>

        <div class="card-tools">
            <a href="{{ route('admin.products.index') }}" class="btn-sm btn-primary">
                Show All Products
            </a>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" >

            @csrf

        <x-input
        field="name"
        text="Name"
        />


        <x-input
        field="slug"
        text="Slug"
        />

        <div class="form-text mb-3 text-muted" style="display: none" id="slug-suggestion" >
            Suggested Slug: <a href="#" id="slug-value"></a> 
        </div>

        <x-input
        field="price"
        text="Price"
        type="number"
        />


        <div class="form-group">
            <label for="on_sale">On sale?</label> <br>

            <div class="icheck-primary">
                <input type="checkbox" id="on_sale" name="on_sale" value="1" 
                @if (old('on_sale') )
                    checked    
                @endif>
                <label for="on_sale">Yes</label> <br>
            </div>

            @error('on_sale')
                <small class="form-text text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <x-input
        field="sale_price"
        text="Sale Price"
        type="number"
        />

        <x-input
        field="description"
        text="Product Details"
        type="textarea"
        />
        
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control @error('category_id')
                is invalid
            @enderror">

            <option value="">Select a category...</option>

            @foreach ($categories as $cat )
                <option 
                value="{{ $cat->id }}"
                @if ( old('category_id') == $cat->id )
                    selected
                @endif>
                {{ $cat->name }}
                </option>
            @endforeach
            @error('category_id')
                <small class="form-text text-danger">
                    {{ $message }}
                </small>
            @enderror
            </select>

            @error('category_id')
                <small class="form-text text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Upload Product Picture</label>
            <input type="file" name="image" id="image">
        </div>

        <button type="submit" class="btn-sm btn-primary">
            <i class="fas fa-fw fa-save mr-2"></i>
            <span>Save</span>
        </button>
        </form>
    </div>
</div>
@endsection
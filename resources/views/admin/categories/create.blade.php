@extends('adminlte::page')

@section('title','Create Category')

@push('js')
    <script>

        $('#name').keyup(function() {

            let title = document.getElementById('name').value;

            if (title == ''){
                $('#slug-suggestion').hide();
                return;
            }

            $.ajax({

                url: "{{ route('admin.categories.slug') }}",
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

<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5;">
            Create New Category
        </h3>

        <div class="card-tools">
            <a href="{{ route('admin.categories.index') }}" class="btn-sm btn-primary">
                Show All Categories
            </a>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" >

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


        <div class="form-group">
            <label for="category_id">Parent Category</label>
            <select name="category_id" id="category_id" class="form-control @error('category_id')
                is invalid
            @enderror">

            <option value="">Select a parent category...</option>

                @foreach ($categories as $cat )
                    <option 
                    value="{{ $cat->id }}"
                    @if ( old('category_id') == $cat->id )
                        selected
                    @endif>
                    {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Upload Category Picture</label>
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
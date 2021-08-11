@extends('adminlte::page')

@section('title', 'Category List')

@section('content')

<x-alert/>
<x-delete/>

    <div class="card">
        <div class="card-header">

            <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5">Categories</h3>
            <div class="card-tools">
              <a href="{{route('admin.categories.create')}}" class="btn-sm btn-primary" >Add New Category</a>
            </div>
            
        </div>
        <div class="card-body p-0">

            @if (count($categories) > 0)              
           
            <table class="table table-bordered table-striped">
                <thead class="thead-dark bg-info">
                    <tr>
                        <td>ID</td>
                        <td>Category Name</td>
                        <td>Slug</td>
                        <td>Parent</td>
                        <td>Actions</td>
                    </tr>
                </thead>

                <tbody>
                    
                    @foreach ($categories as $category )

                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            @if ($category->category_id)
                                <a href="{{ route('admin.categories.show',$category->category_id)}}">
                                    {{ $category->parentCategory->name }}
                                </a>
                            @endif    
                        </td>

                        <td>
                            <a 
                                href="{{ route('admin.categories.show', $category->id) }}" 
                                class="btn-sm btn-primary mr-2">
                                Show Details
                            </a>

                            <a 
                                href="{{ route('admin.categories.edit', $category->id) }}" 
                                class="btn-sm btn-secondary mr-2">
                                Edit category
                            </a>
                            
                            <a href="#" onclick="confirmDelete({{ $category->id }})" class="btn-sm btn-danger" > Delete 
                            </a>

                            <form id="delete-form-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category) }}" method="POST">

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
                No more categories available !
            </div>

            @endif
            
        </div>
        @if ($categories->perpage() < $categories->total() )
            <div class="card-footer">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection

@extends('adminlte::page')

@section('title','Category Details')

@section('content')

<x-alert/>

<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5;">
            Category Details
        </h3>

        <div class="card-tools">
            <a href="{{ route('admin.categories.index') }}" class="btn-sm btn-primary">
                Show All Categories
            </a>
        </div>
    </div>
    
    <div class="card-body p-0">
        <table class="table">
            <tr>
                <th style="width: 15%;">ID</th>
                <td>{{ $category->id }}</td>
            </tr>
            
            @if ($category->image)
            <tr>
                <th>Category Picture</th>
                <td>                    
                    <img src="{{ $category->image }}" height="160px" width="200px" alt="Category Picture">                                                        
                </td>
            </tr>
            @endif 

            <tr>
                <th>Name</th>
                <td>{{ $category->name }}</td>
            </tr>

            <tr>
                <th>Slug</th>
                <td>{{ $category->slug }}</td>
            </tr>

            <tr>
                <th>Parent Category</th>
                <td>
                    @if ($category->category_id)
                        <a href="{{ route('admin.categories.show',$category->category_id)}}">
                            {{ $category->parentCategory->name }}
                        </a>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $category->description}}</td>
            </tr>
            
            <tr>
                <th>Created</th>
                <td>{{ $category-> created_at }}</td>
            </tr>
            
        </table>
    </div>
</div>
@endsection
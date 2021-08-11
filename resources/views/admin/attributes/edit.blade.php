@extends('adminlte::page')

@section('title','Add Attribute')

@section('content')

<x-alert/>

<x-editor field="description"/>


<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5;">
            Add Attribute
        </h3>

        <div class="card-tools">
            <a href="{{ route('admin.attributes.index') }}" class="btn-sm btn-primary">
                Show All Attributes
            </a>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.attributes.update', $attribute) }}" enctype="multipart/form-data" >

            @csrf
            @method('PUT')

            <x-input
            field="name"
            text="Name"
            :current="$attribute->name"
            />

            <x-input
            field="description"
            text="Description"
            type="textarea"
            :current="$attribute->description"
            />

        <button type="submit" class="btn-sm btn-primary">
            <i class="fas fa-fw fa-save mr-2"></i>
            <span>Save</span>
        </button>
        </form>
    </div>
</div>
@endsection
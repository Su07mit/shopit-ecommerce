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
        <form method="POST" action="{{ route('admin.attributes.store') }}" enctype="multipart/form-data" >

            @csrf

            <x-input
            field="name"
            text="Name"
            />

            <x-input
            field="description"
            text="Description"
            type="textarea"
            />

        <button type="submit" class="btn-sm btn-primary">
            <i class="fas fa-fw fa-save mr-2"></i>
            <span>Save</span>
        </button>
        </form>
    </div>
</div>
@endsection
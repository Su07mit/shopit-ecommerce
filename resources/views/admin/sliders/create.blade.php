@extends('adminlte::page')

@section('title','Add Slider')

@section('content')

<x-alert/>
<x-editor field="description"/>

<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5;">
            Add New Slider
        </h3>

        <div class="card-tools">
            <a href="{{ route('admin.sliders.index') }}" class="btn-sm btn-primary">
                Show All Sliders
            </a>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data" >

            @csrf

        <x-input
        field="name"
        text="Name"
        />

        <div class="form-group">
            <label for="image">Upload Slider Picture</label> <br>
            <input type="file" name="image" id="image">
        </div>

        <x-input
        field="url"
        text="URL"
        />


        <button type="submit" class="btn-sm btn-primary">
            <i class="fas fa-fw fa-save mr-2"></i>
            <span>Save</span>
        </button>
        </form>
    </div>
</div>
@endsection
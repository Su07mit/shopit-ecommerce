@extends('adminlte::page')

@section('title','Add Slider')

@section('content')

<x-alert/>
<x-editor field="description"/>

<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5;">
            Update Slider
        </h3>

        <div class="card-tools">
            <a href="{{ route('admin.sliders.index') }}" class="btn-sm btn-primary">
                Show All Sliders
            </a>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.sliders.update', $slider->id) }}" enctype="multipart/form-data" >

            @csrf

            @method('PUT')

        <x-input
        field="name"
        text="Name"
        :current="$slider->name"
        />

        <div class="form-group">
            <label for="image">Upload Slider Picture</label> <br>
            <input type="file" name="image" id="image">
        </div>

        @if ($slider->media_id)
            <div class="mb-2 form-group">
                <label for="image">Current Slider Picture</label>
                <img src="/storage/{{ $slider->media->path }}" class="ml-2" height="50px" alt="Slider Picture">
            </div>
        @endif

        <x-input
        field="url"
        text="URL"
        :current="$slider->url"
        />


        <button type="submit" class="btn-sm btn-primary">
            <i class="fas fa-fw fa-save mr-2"></i>
            <span>Save</span>
        </button>
        </form>
    </div>
</div>
@endsection
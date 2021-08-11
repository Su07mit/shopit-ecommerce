@extends('adminlte::page')

@section('title','Slider Details')

@section('content')

<x-alert/>

<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5;">
            Slider Details
        </h3>

        <div class="card-tools">
            <a href="{{ route('admin.sliders.index') }}" class="btn-sm btn-primary">
                Show All Sliders
            </a>
        </div>
    </div>
    
    <div class="card-body p-0">
        <table class="table">
            <tr>
                <th style="width: 15%;">ID</th>
                <td>{{ $slider->id }}</td>
            </tr>

            
            <tr>
                <th>Slider Picture</th>
                <td>                   
                    <img src="/storage/{{ $slider->media->path }}" height="160px" alt="Slider Picture">                                                        
                </td>
            </tr>

            <tr>
                <th>Name</th>
                <td>{{ $slider->name }}</td>
            </tr>

            <tr>
                <th>Slug</th>
                <td>{{ $slider->url }}</td>
            </tr>
            
            <tr>
                <th>Created</th>
                <td>{{ $slider-> created_at }}</td>
            </tr>
            
        </table>
    </div>
</div>
@endsection
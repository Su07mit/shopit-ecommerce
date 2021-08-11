@extends('adminlte::page')

@section('title', 'Sliders List')

@section('content')

<x-alert/>
<x-delete/>

    <div class="card">
        <div class="card-header">

            <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5">Sliders</h3>
            <div class="card-tools">
              <a href="{{route('admin.sliders.create')}}" class="btn-sm btn-primary" >Add New Slider</a>
            </div>
            
        </div>
        <div class="card-body p-0">

            @if (count($sliders) > 0)              
           
            <table class="table table-bordered table-striped">
                <thead class="thead-dark bg-info">
                    <tr>
                        <td>ID</td>
                        <td>Image</td>
                        <td>Slider Name</td>
                        <td>URL</td>
                        <td>Actions</td>
                    </tr>
                </thead>

                <tbody>
                    
                    @foreach ($sliders as $slider )

                    <tr>
                        <td>{{ $slider->id }}</td>
                        <td>
                            <img src="/storage/{{ $slider->media->path }}" height="50px" alt="Slider Image">
                        </td>
                        <td>{{ $slider->name }}</td>
                        <td>{{ $slider->url }}</td>
                        <td>
                            <a 
                                href="{{ route('admin.sliders.show', $slider->id) }}" 
                                class="btn-sm btn-primary mr-2">
                                Show Details
                            </a>

                            <a 
                                href="{{ route('admin.sliders.edit', $slider->id) }}" 
                                class="btn-sm btn-secondary mr-2">
                                Edit Slider
                            </a>
                            
                            <a href="#" onclick="confirmDelete({{ $slider->id }})" class="btn-sm btn-danger" > Delete 
                            </a>

                            <form id="delete-form-{{ $slider->id }}" action="{{ route('admin.sliders.destroy', $slider) }}" method="POST">

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
                No more sliders available !
            </div>

            @endif
            
        </div>
        @if ($sliders->perpage() < $sliders->total() )
            <div class="card-footer">
                {{ $sliders->links() }}
            </div>
        @endif
    </div>
@endsection

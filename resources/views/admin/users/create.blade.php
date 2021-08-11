@extends('adminlte::page')

@section('title','Create User')

@section('content')

<x-alert/>

<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5;">
            Create User
        </h3>

        <div class="card-tools">
            <a href="{{ route('admin.users.index') }}" class="btn-sm btn-primary">
                Show All Users
            </a>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data" >

            @csrf

        <x-input
        field="name"
        text="Enter Full Name"
        />

        <x-input
        field="email"
        text="Enter E-mail"
        type="email"
        />

        <x-input
        field="password"
        text="Enter Password"
        type="password"
        />

        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control 
            @error('role')
                is invalid
            @enderror">
                @foreach ($roles as $role )
                    <option 
                    value="{{ $role }}"
                    @if ( old('role') == $role )
                        selected
                    @endif>
                    {{ $role }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Upload Profile Picture</label>
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
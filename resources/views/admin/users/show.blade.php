@extends('adminlte::page')

@section('title','User Details')

@section('content')

<x-alert/>

<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5;">
            User Details
        </h3>

        <div class="card-tools">
            <a href="{{ route('admin.users.index') }}" class="btn-sm btn-primary">
                Show All Users
            </a>
        </div>
    </div>
    
    <div class="card-body p-0">
        <table class="table">
            <tr>
                <th style="width: 15%;">ID</th>
                <td>{{ $user->id }}</td>
            </tr>
            
            <tr>
                <th>Profile Picture</th>
                <td>
                    @if ($user->image)
                        <img src="{{ $user->image }}" height="100px" width="120px" alt="Profile Picture">
                    @endif                   
                </td>
            </tr>

            <tr>
                <th>Name</th>
                <td>{{ $user->name }}</td>
            </tr>

            <tr>
                <th>Email</th>
                <td>{{ $user->email}}</td>
            </tr>
            
            <tr>
                <th>Role</th>
                <td>{{ $user->role }}</td>
            </tr>
            
            <tr>
                <th>Created</th>
                <td>{{ $user-> created_at }}</td>
            </tr>
            
        </table>
    </div>
</div>
@endsection
@extends('adminlte::page')

@section('title', 'Users List')

@section('content')

<x-alert/>
<x-delete/>

    <div class="card">
        <div class="card-header">

            <h3 class="card-title text-bold" style="font-size: 1.3rem; line-height: 1.5">Users</h3>
            <div class="card-tools">
              <a href="{{route('admin.users.create')}}" class="btn-sm btn-primary" >Add User</a>
            </div>
            
        </div>
        <div class="card-body p-0">

            @if (count($users) > 0)              
           
            <table class="table table-bordered table-striped">
                <thead class="thead-dark bg-info">
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Role</td>
                        <td>Added at:</td>
                        <td>Actions</td>
                    </tr>
                </thead>

                <tbody>
                    
                    @foreach ($users as $user )

                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user-> created_at }}</td>
                        <td>
                            <a 
                                href="{{ route('admin.users.show', $user->id) }}" 
                                class="btn-sm btn-primary mr-2">
                                Show Details
                            </a>

                            <a 
                                href="{{ route('admin.users.edit', $user->id) }}" 
                                class="btn-sm btn-secondary mr-2">
                                Edit User
                            </a>
                            
                            <a href="#" onclick="confirmDelete({{ $user->id }})" class="btn-sm btn-danger" > Delete 
                            </a>

                            <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST">

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
                No more users available !
            </div>

            @endif
            
        </div>
        @if ($users->perpage() < $users->total() )
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection

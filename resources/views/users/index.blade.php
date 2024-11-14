@extends('layouts.app')

@section('content')
<div class="col-lg-12 margin-tb">
    <div class="pull-left">
        <h2>Users Management</h2>
    </div>
    <div class="pull-right">

    </div>

    @session('success')
    <div class="alert alert-success" role="alert">
        {{ $value }}
    </div>
    @endsession
    <div class="card">
        <div class="card-header">Roles Data
            <a class="btn btn-success mb-2 float-end btn-sm" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> Create New
                User</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                            <label class="badge bg-success">{{ $v }}</label>
                            @endforeach
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}"><i
                                    class="fa-solid fa-list"></i>
                                Show</a>
                            <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}"><i
                                    class="fa-solid fa-pen-to-square"></i> Edit</a>
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i>
                                    Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {!! $data->links('pagination::bootstrap-5') !!}
</div>

@endsection

@extends('layouts.app')

@section('content')
    <div class="col-md-8 margin-tb">

        @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
        @endsession
        <div class="card">
            <div class="card-header"><h5>User Data
                    <a class="btn btn-success mb-2 float-end btn-sm" href="{{ route('users.create') }}"><i
                            class="fa fa-plus"></i> Create New
                        User</a>
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th width="180px">Action</th>
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
                                <div class="btn-group">
                                    <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}"><i
                                            class="bi bi-pencil"></i></a>
                                    <x-delete-button url="{{ route('users.destroy', $user->id) }}"/>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

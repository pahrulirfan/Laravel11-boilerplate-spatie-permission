@extends('layouts.app')

@section('content')
    <div class="col-md-4 margin-tb">
        <div class="card">
            <div class="card-header">
                <h5>
                    Role Data
                    <div class="float-end">
                        <a class="btn btn-success btn-sm mb-2" href="{{ route('roles.create') }}"><i
                                class="fa fa-plus"></i>
                            Create New Role</a>
                    </div>
                </h5>

            </div>
            <div class="card-body">
                @session('success')
                <div class="alert alert-success" role="alert">
                    {{ $value }}
                </div>
                @endsession

                <table class="table table-bordered">
                    <tr>
                        <th width="100px">No</th>
                        <th>Name</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $role->name }}</td>
                            <td width="30%">
                                <div class="btn-group">
                                    @can('role-edit')
                                        <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}"><i
                                                class="bi bi-pencil"></i></a>
                                    @endcan

                                    @can('role-delete')
                                        <x-delete-button url="{{ route('roles.destroy', $role->id) }}"/>
                                        {{--                                        <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">--}}
                                        {{--                                        @csrf--}}
                                        {{--                                        @method('DELETE')--}}

                                        {{--                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i>--}}
                                        {{--                                        </button>--}}
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>

@endsection

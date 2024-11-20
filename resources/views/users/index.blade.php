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
                <div class="table-responsive">
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
                                <td>{{ $loop->iteration }}</td>
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
                                    @role('Admin')
                                    <div class="btn-group">
                                        <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}"><i
                                                class="bi bi-pencil"></i></a>
                                        @if (Auth::id() !== $user->id)
                                            <x-delete-button url="{{ route('users.destroy', $user->id) }}"/>
                                        @endif
                                    </div>
                                    @endrole
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(url, onSuccess = () => {
        }, onError = () => {
        }) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Tampilkan notifikasi sukses di kanan atas
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: data.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                });

                                // Tunda refresh halaman selama 3 detik
                                setTimeout(() => {
                                    location.reload();
                                }, 3000);

                                onSuccess(data);
                            } else {
                                // Tampilkan notifikasi error di kanan atas
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'error',
                                    title: data.message || 'Something went wrong.',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                onError(data);
                            }
                        })
                        .catch(error => {
                            // Tampilkan notifikasi error jika permintaan gagal
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: 'Something went wrong.',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            console.error(error);
                            onError(error);
                        });
                }
            });
        }
    </script>
@endpush

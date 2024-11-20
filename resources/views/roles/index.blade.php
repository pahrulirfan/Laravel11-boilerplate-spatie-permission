@extends('layouts.app')

@section('content')
    <div class="col-lg-5 col-sm-12 col-md-6 margin-tb">
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
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th width="100px">No</th>
                            <th>Name</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->name }}</td>
                                <td width="30%">
                                    <div class="btn-group">
                                        @if($role->name != 'Admin')
                                            <a class="btn btn-primary btn-sm"
                                               href="{{ route('roles.edit',$role->id) }}"><i
                                                        class="bi bi-pencil"></i></a>

                                            @role('Admin')
                                            <x-delete-button url="{{ route('roles.destroy', $role->id) }}"/>
                                            {{--                                        <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">--}}
                                            {{--                                        @csrf--}}
                                            {{--                                        @method('DELETE')--}}

                                            {{--                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i>--}}
                                            {{--                                        </button>--}}
                                            {{--                                        </form>--}}
                                            @endrole
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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
    <script>
        $(document).ready(function () {
            // Sembunyikan alert setelah 3 detik
            setTimeout(function () {
                $('.alert').fadeOut(500, function () {
                    $(this).remove(); // Hapus elemen dari DOM setelah animasi selesai
                });
            }, 3000); // 3000ms = 3 detik
        });
    </script>
@endpush

@extends('layouts.app')

@section('content')
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Selamat Datang</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Anda telah berhasil login
                </div>
            </div>
        </div>
@endsection

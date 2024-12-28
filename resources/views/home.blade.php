@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Impersonation Dashboard') }}</div>

                <div class="card-body">
                    {{-- Display impersonated user details --}}
                    @if (auth()->user()->isImpersonated())
                        <div class="alert alert-info">
                            <strong>Impersonating:</strong> {{ auth()->user()->name }} ({{ auth()->user()->email }})
                        </div>

                        {{-- Display original user details --}}
                        @if(session('original_user'))
                            <div class="alert alert-secondary">
                                <strong>Your current user:</strong> 
                                {{ session('original_user')->name }} ({{ session('original_user')->email }})
                            </div>
                        @endif

                        <a href="{{ route('impersonate.stop') }}" class="btn btn-danger">Leave Impersonation</a>
                    @else
                        <div class="alert alert-warning">
                            You are not impersonating anyone.
                        </div>
                    @endif

                    {{-- Users Table --}}
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{ route('impersonate.start', $user->id) }}" class="btn btn-primary">Impersonate</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

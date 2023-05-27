@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Users') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h2>{{ __('Users') }}</h2>
                        <div class="mb-3">
                            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> {{ __('Add user') }}</a>
                        </div>
                        <div>
                            <table class="table table-hover table-bordered table-sm">
                                <thead class="table-light">
                                <tr>
                                    <th>{{ __('User name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Role') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ __($user->role) }}</td>
                                        <td>
                                            @if($user->role === constant('App\Models\User::ROLE_USER'))
                                                <a href="{{ route('user.edit', $user) }}" class="btn btn-secondary btn-sm"><i class="bi bi-pencil-fill"></i> {{ __('Edit') }}</a>
                                            @else
                                                <a href="#" class="btn btn-secondary btn-sm disabled"><i class="bi bi-pencil-fill"></i> {{ __('Edit') }}</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">{{ __('No users') }}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

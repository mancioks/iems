@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit user') }}</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('user.update', $user) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-2">
                                <label for="name">{{ __('User name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="{{ __('User name') }}">
                                @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="url">{{ __('User email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="{{ __('User email') }}">
                                @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="value">{{ __('Password') }}</label>
                                <input type="password" class="form-control" name="password" id="user" placeholder="{{ __('Password') }}">
                                @error('password')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary mt-2">{{ __('Update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

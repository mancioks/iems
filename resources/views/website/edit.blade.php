@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit website') }}</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('website.update', $website) }}">
                            @csrf
                            @method('put')
                            <div class="form-group mb-2">
                                <label for="name">{{ __('Website name') }}</label>
                                <input type="text" class="form-control" id="name" value="{{ $website->name }}" disabled>
                            </div>
                            <div class="form-group mb-2">
                                <label for="url">{{ __('Website URL') }}</label>
                                <input type="text" class="form-control" id="url" value="{{ $website->url }}" disabled>
                            </div>
                            <div class="form-group mb-2">
                                <label for="value">{{ __('Username') }}</label>
                                <input type="text" class="form-control" name="user" id="user" value="{{ $website->user }}" placeholder="{{ __('Username') }}">
                                @error('user')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="value">{{ __('Token') }}</label>
                                <input type="text" class="form-control" name="token" id="token" value="{{ $website->token }}" placeholder="{{ __('Token') }}">
                                @error('token')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary mt-2"><i class="bi bi-arrow-clockwise"></i> {{ __('Update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

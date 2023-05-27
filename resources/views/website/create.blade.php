@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create website') }}</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('website.store') }}">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="name">{{ __('Website name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Website name') }}">
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="url">{{ __('Website URL') }}</label>
                                <input type="text" class="form-control" id="url" name="url" placeholder="{{ __('Website URL') }}">
                                @error('url')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="value">{{ __('Username') }}</label>
                                <input type="text" class="form-control" name="user" id="user" placeholder="{{ __('Username') }}">
                                @error('user')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="value">{{ __('Token') }}</label>
                                <input type="text" class="form-control" name="token" id="token" placeholder="{{ __('Token') }}">
                                @error('token')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary mt-2"><i class="bi bi-plus"></i> {{ __('Create') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

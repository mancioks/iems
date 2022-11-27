@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit language') }}</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('language.update', $language) }}">
                            @csrf
                            @method('put')
                            <div class="form-group mb-2">
                                <label for="name">{{ __('Language name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $language->name }}">
                                @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="code">{{ __('Language code') }}</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{ $language->code }}">
                                @error('code')
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

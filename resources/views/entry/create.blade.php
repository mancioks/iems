@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create entry') }}</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('entry.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="value">{{ __('Value') }}</label>
                                <input type="text" class="form-control" name="value" id="value" placeholder="{{ __('Enter value') }}">
                                @error('value')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                                <small id="emailHelp" class="form-text text-muted">{{ __('Key will be created automatically') }}</small>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary mt-2"><i class="bi bi-plus-circle"></i> {{ __('Create') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

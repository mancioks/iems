@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit entry') }}</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('entry.update', $entry) }}">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="value">{{ __('Value') }}</label>
                                <input type="text" class="form-control" name="value" id="value" value="{{ $entry->value }}" placeholder="{{ __('Entry value') }}">
                                @error('value')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                                <small id="emailHelp" class="form-text text-muted">{{ __('Current entry value:') }} <b>{{ $entry->value }}</b></small>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary mt-2"><i class="bi bi-arrow-clockwise"></i> {{ __('Update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

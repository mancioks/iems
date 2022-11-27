@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Languages') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h2>{{ __('Languages') }}</h2>
                        <div class="mb-3">
                            <a href="{{ route('language.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> {{ __('Add language') }}</a>
                        </div>
                        <div>
                            <table class="table table-hover table-bordered table-sm">
                                <thead class="table-light">
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Code') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($languages as $language)
                                    <tr>
                                        <td>{{ $language->name }}</td>
                                        <td>{{ $language->code }}</td>
                                        <td>
                                            <a href="{{ route('language.edit', $language) }}" class="btn btn-secondary btn-sm"><i class="bi bi-pencil-fill"></i> {{ __('Edit') }}</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">{{ __('No languages') }}</td>
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

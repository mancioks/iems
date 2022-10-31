@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2>{{ __('Entries') }}</h2>
                    <div>
                        <table class="table table-hover table-bordered table-sm">
                            <thead class="table-light">
                            <tr>
                                <th>{{ __('Key') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Value') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($entries as $entry)
                                <tr>
                                    <td>{{ $entry->id }}</td>
                                    <td>{{ $entry->type }}</td>
                                    <td>{{ $entry->value }}</td>
                                    <td>
                                        <a href="{{ route('entry.edit', $entry) }}" class="btn btn-secondary btn-sm"><i class="bi bi-pencil-fill"></i> {{ __('Edit') }}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">{{ __('No entries') }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('entry.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> {{ __('Create entry') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

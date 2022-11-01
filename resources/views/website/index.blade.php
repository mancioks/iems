@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Websites') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h2>{{ __('Websites') }}</h2>
                        <div class="mb-3">
                            <a href="{{ route('website.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> {{ __('Add website') }}</a>
                        </div>
                        <div>
                            <table class="table table-hover table-bordered table-sm">
                                <thead class="table-light">
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Url') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($websites as $website)
                                    <tr>
                                        <td>{{ $website->name }}</td>
                                        <td>{{ $website->url }}</td>
                                        <td>
                                            @if($website->user && $website->token)
                                                <span class="badge bg-success">{{ __('Activated') }}</span>
                                            @else
                                                <span class="badge bg-warning text-dark">{{ __('Not activated') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('website.edit', $website) }}" class="btn btn-secondary btn-sm"><i class="bi bi-pencil-fill"></i> {{ __('Edit') }}</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">{{ __('No websites') }}</td>
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

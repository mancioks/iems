@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Activity') }}</div>

                    <div class="card-body">
                        <h2>{{ __('Activity') }}</h2>
                        <div>
                            {{ $activities->appends($_GET)->links('pagination::bootstrap-5') }}
                        </div>
                        <div>
                            <table class="table table-hover table-bordered table-sm">
                                <thead class="table-light">
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Action') }}</th>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Date') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($activities as $activity)
                                    <tr>
                                        <td>{{ $activity->id }}</td>
                                        <td>{{ $activity->type }}</td>
                                        <td>{{ $activity->action }}</td>
                                        <td>{{ $activity->user->name }}</td>
                                        <td>{{ $activity->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">{{ __('No activity') }}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{ $activities->appends($_GET)->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

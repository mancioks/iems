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
                    <div class="mb-3">
                        <div class="dropdow d-inline-block">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-plus-circle"></i> {{ __('Create entry') }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @foreach($types as $key => $type)
                                    <li><a class="dropdown-item" href="{{ route('entry.create') }}/{{ $key }}">{{ $type }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('entry.sync') }}" class="btn btn-success btn-sm"><i class="bi bi-arrow-clockwise"></i> {{ __('Synchronize entries') }}</a>
                    </div>
                    <div>
                        <form action="{{ route('home') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text" name="search" class="form-control" placeholder="{{ __('Search...') }}" value="{{ request()->has('search') ? request()->get('search') : '' }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div>
                        {{ $entries->appends($_GET)->links('pagination::bootstrap-5') }}
                    </div>
                    <div>
                        <table class="table table-hover table-bordered table-sm">
                            <thead class="table-light">
                            <tr>
                                <th>{{ __('Key') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Value') }}</th>
                                <th>{{ __('Shortcode') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($entries as $entry)
                                <tr>
                                    <td>{{ $entry->id }}</td>
                                    <td>{{ $entry->type }}</td>
                                    <td class="overflow-auto child-images-max-width max-400">{!! $entry->value !!}</td>
                                    <td>
                                        <code style="cursor: pointer;" onclick="navigator.clipboard.writeText('[iems id={{ $entry->id }}]')">
                                            [iems id={{ $entry->id }}]
                                        </code>
                                    </td>
                                    <td>
                                        <a href="{{ route('entry.edit', $entry) }}" class="btn btn-secondary btn-sm"><i class="bi bi-pencil-fill"></i> {{ __('Edit') }}</a>
                                        <form action="{{ route('entry.destroy', $entry) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm confirm"><i class="bi bi-trash-fill"></i> {{ __('Delete') }}</button>
                                        </form>
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
                    <div>
                        {{ $entries->appends($_GET)->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

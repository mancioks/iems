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
                            <div class="card mt-3 mb-2 shadow shadow-sm">
                                <div class="card-header bg-secondary text-white">{{ __('Translations') }}</div>
                                <div class="card-body">
                                    @foreach($languages as $language)
                                        <div class="form-group mb-1">
                                            <label for="translation_{{ $language->code }}">
                                                <img
                                                    src="https://countryflagsapi.com/svg/{{ $language->code === 'en' ? 'us' : $language->code }}"
                                                    height="12"
                                                    alt="{{ $language->code }}"
                                                    class="mb-1 rounded rounded-1 shadow shadow-sm"
                                                />
                                                {{ $language->name }} ({{ strtoupper($language->code) }})
                                                <button data-language="{{ $language->code }}"
                                                        onclick="event.preventDefault();getTranslation(this);"
                                                        class="border-0 bg-transparent text-primary"
                                                >
                                                    <i class="bi bi-translate"></i>
                                                </button>
                                            </label>
                                            <input type="text" class="form-control form-control-sm" id="translation_{{ $language->code }}" name="translation[{{ $language->id }}]" value="{{ old('translation.' . $language->id) }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary mt-2"><i class="bi bi-plus-circle"></i> {{ __('Create') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function getTranslation(e) {
            let value = document.getElementById('value').value;
            let language = e.getAttribute('data-language');

            fetch('{{ route('api.translate') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    text: value,
                    target: language
                })
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('translation_' + language).value = data.translation;
                });
        }
    </script>
@endsection

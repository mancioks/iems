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
                                <input type="{{ $entry->type === 'number' ? 'number' : 'text' }}" class="form-control {{ $entry->type === 'block' ? 'wysiwyg' : '' }}" name="value" id="value" value="{{ $entry->value }}" placeholder="{{ __('Enter value') }}">
                                @error('value')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                                <small id="emailHelp" class="form-text text-muted">{{ __('Current entry value:') }}</small>
                                <div class="overflow-auto">
                                    {!! $entry->value !!}
                                </div>
                            </div>
                            @if($entry->type !== 'number')
                                <button class="btn btn-secondary w-100 mt-2 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#translations" aria-expanded="false" aria-controls="translations">
                                    <i class="bi bi-translate"></i> {{ __('Translations') }}
                                </button>
                                <div class="collapse" id="translations">
                                    <div class="card shadow shadow-sm">
                                        <div class="card-body">
                                            @foreach($languages as $language)
                                                <div class="form-group mb-1">
                                                    <label for="translation_{{ $language->code }}">
                                                        <span class="fi fi-{{ $language->code === 'en' ? 'us' : $language->code }} rounded rounded-1"></span>
                                                        {{ $language->name }} ({{ strtoupper($language->code) }})
                                                        <button data-language="{{ $language->code }}"
                                                                onclick="event.preventDefault();getTranslation(this);"
                                                                class="border-0 bg-transparent text-primary {{ $entry->type === 'block' ? 'd-none' : '' }}"
                                                        >
                                                            <i class="bi bi-translate"></i>
                                                        </button>
                                                    </label>
                                                    <input type="text" class="form-control form-control-sm entry-input {{ $entry->type === 'block' ? 'wysiwyg' : '' }}" id="translation_{{ $language->code }}" name="translation[{{ $language->id }}]" value="{{ $entry->translations->where('language_id', $language->id)->first()->translation ?? '' }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <button type="submit" class="btn btn-sm btn-primary mt-2"><i class="bi bi-arrow-clockwise"></i> {{ __('Update') }}</button>
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

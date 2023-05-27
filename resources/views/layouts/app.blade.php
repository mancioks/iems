<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        // document on load alert
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.wysiwyg').forEach(function (element) {
                let spinner = document.createElement('div');
                spinner.classList.add('wisiwygLoader', 'd-flex', 'justify-content-center', 'align-items-center', 'mt-n4', 'mb-3');
                spinner.innerHTML = '<div class="spinner-grow text-secondary" role="status"><span class="visually-hidden">Loading...</span></div>';
                element.parentNode.insertBefore(spinner, element.nextSibling);
            });
        });

        tinymce.init({
            selector: '.wysiwyg',
            //skin: 'tinymce-5',
            plugins: 'code table lists emoticons wordcount link image fullscreen preview visualblocks searchreplace autolink autoresize advlist image media table anchor pagebreak nonbreaking insertdatetime advlist lists help charmap quickbars',
            toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | link | image | fullscreen | preview | visualblocks | searchreplace | autolink | autoresize | advlist | image | media | anchor | pagebreak | nonbreaking | insertdatetime | advlist | lists | help | charmap | quickbars | emoticons | wordcount | removeformat',
            promotion: false,
            branding: false,
            image_class_list: [
                {title: 'Responsive', value: 'img-responsive'}
            ],
            setup: function (ed) {
                ed.on('init', function () {
                    document.querySelectorAll('.wisiwygLoader').forEach(function (el) {
                        el.classList.add('d-none');
                    });
                });
            },
        });
    </script>
    @yield('header-scripts')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('website.index') }}">{{ __('Websites') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('language.index') }}">{{ __('Languages') }}</a>
                            </li>
                            @if(auth()->user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.index') }}">{{ __('Users') }}</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.confirm').forEach(function (element) {
                element.addEventListener('click', function (e) {
                    if (!confirm('{{ __('Are you sure?') }}')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>

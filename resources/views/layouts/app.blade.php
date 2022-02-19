<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal/modals.css') }}">
    @if(Route::currentRouteName() == 'logs')
    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
    @endif

    @toastr_css
    <title>@yield('title')</title>
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900" id="app">
        @include('inc.header')
        <header class="bg-white shadow dark:bg-gray-800">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-400 leading-tight">@yield('heading')</h2>
            </div>
        </header>
        <main>
            <div class="py-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </div>
        </main>
        @include('inc.footer')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/theme.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    @if(Route::currentRouteName() == 'home')
    <script src="{{ asset('js/bundle/bundle.min.js') }}"></script>
    <script src="{{ asset('js/extra.js') }}"></script>
    <script src="{{ asset('js/camera.js') }}"></script>
    @endif
    @if(Route::currentRouteName() == 'profile')
    <script src="{{ asset('js/user/update_info.js') }}"></script>
    @endif
    @if(Route::currentRouteName() == 'users')
    <script src="{{ asset('js/user/change_notify.js') }}"></script>
    @endif
    @if(Route::currentRouteName() == 'logs')
    <script src="{{ asset('js/datatables/moment.min.js') }}"></script>
    <script src="{{ asset('js/datatables/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('js/datatables/datepicker.js') }}"></script>
    <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/datatable.js') }}"></script>
    @endif
    @if(Route::currentRouteName() == 'artisan')
    <script src="{{ asset('js/artisan.js') }}"></script>
    @endif
    @toastr_js
    @toastr_render
    <div class="modal fade" id="cam_popup" tabindex="-1" aria-labelledby="cam_popup" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content dark:bg-gray-800 dark:text-white">
                <div class="m_body">
                </div>
            </div>
        </div>
    </div>
</body>

</html>
